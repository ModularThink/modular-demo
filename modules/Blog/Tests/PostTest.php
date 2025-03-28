<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Modules\Blog\Models\Post;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    Role::create(['name' => 'root']);
    $this->user->assignRole('root');

    $this->loggedRequest = $this->actingAs($this->user);

    $this->post = Post::factory()->create();
});

afterEach(function () {
    if ($this->post->image) {
        Storage::disk('public')->delete('blog/'.$this->post->image);
    }
});

test('post list can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/blog-post');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogPost/PostIndex')
            ->has(
                'posts.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->post->id)
                    ->where('image_url', $this->post->image_url)
                    ->where('title', $this->post->title)
                    ->where('status', $this->post->status)
            )
    );
});

test('post create page can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/blog-post/create');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogPost/PostForm')
    );
});

test('post can be created', function () {
    $response = $this->loggedRequest->post('/admin/blog-post', [
        'blog_author_id' => null,
        'blog_category_id' => null,
        'title' => 'Post Title',
        'summary' => 'Post Summary',
        'content' => 'Post Content',
        'image' => null,
        'meta_tag_title' => 'Post Title Tag',
        'meta_tag_description' => 'Post Description Tag',
        'published_at' => null,
    ]);

    $posts = Post::all();

    $response->assertRedirect('/admin/blog-post');
    $this->assertCount(2, $posts);
    $this->assertEquals('Post Title', $posts->last()->title);
});

test('post edit page can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/blog-post/'.$this->post->id.'/edit');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogPost/PostForm')
            ->has(
                'post',
                fn (Assert $page) => $page
                    ->where('id', $this->post->id)
                    ->where('blog_author_id', $this->post->blog_author_id)
                    ->where('blog_category_id', $this->post->blog_category_id)
                    ->where('title', $this->post->title)
                    ->where('slug', $this->post->slug)
                    ->where('summary', $this->post->summary)
                    ->where('content', $this->post->content)
                    ->where('image', $this->post->image)
                    ->where('image_url', $this->post->image_url)
                    ->where('meta_tag_title', $this->post->meta_tag_title)
                    ->where('meta_tag_description', $this->post->meta_tag_description)
                    ->where('tags', [])
                    ->where('published_at', $this->post->published_at->toDateString())
            )
    );
});

test('post can be updated', function () {
    $response = $this->loggedRequest->put('/admin/blog-post/'.$this->post->id, [
        'blog_author_id' => null,
        'blog_category_id' => null,
        'title' => 'New Post Title',
        'summary' => 'Post Summary',
        'content' => 'Post Content',
        'meta_tag_title' => 'Post Title Tag',
        'meta_tag_description' => 'Post Description Tag',
        'published_at' => '2023-12-13',
    ]);

    $response->assertRedirect('/admin/blog-post');

    $redirectResponse = $this->loggedRequest->get('/admin/blog-post');
    $redirectResponse->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogPost/PostIndex')
            ->has(
                'posts.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->post->id)
                    ->where('title', 'New Post Title')
                    ->where('image_url', $this->post->image_url)
                    ->where('status', 'Published')
            )
    );
});

test('post can be deleted', function () {
    $response = $this->loggedRequest->delete('/admin/blog-post/'.$this->user->id);

    $response->assertRedirect('/admin/blog-post');

    $this->assertCount(0, Post::all());
});
