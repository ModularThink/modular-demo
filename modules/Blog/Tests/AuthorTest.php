<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Modules\Blog\Models\Author;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    Role::create(['name' => 'root']);
    $this->user->assignRole('root');

    $this->loggedRequest = $this->actingAs($this->user);

    $this->author = Author::factory()->create();
});

afterEach(function () {
    if ($this->author->image) {
        Storage::disk('public')->delete('blog/'.$this->author->image);
    }
});

test('author list can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/blog-author');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogAuthor/AuthorIndex')
            ->has(
                'authors.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->author->id)
                    ->where('name', $this->author->name)
                    ->where('email', $this->author->email)
                    ->where('image_url', $this->author->image_url)
                    ->where('github_handle', $this->author->github_handle)
                    ->where('twitter_handle', $this->author->twitter_handle)
            )
    );
});

test('author create page can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/blog-author/create');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogAuthor/AuthorForm')
    );
});

test('author can be created', function () {
    $response = $this->loggedRequest->post('/admin/blog-author', [
        'name' => 'New Name',
        'bio' => 'New Bio',
        'email' => 'new@email.com',
        'github_handle' => 'github user',
        'twitter_handle' => 'twitter user,',
    ]);

    $authors = Author::all();

    $response->assertRedirect('/admin/blog-author');
    $this->assertCount(2, $authors);
    $this->assertEquals('New Name', $authors->last()->name);
});

test('author edit page can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/blog-author/'.$this->author->id.'/edit');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogAuthor/AuthorForm')
            ->has(
                'author',
                fn (Assert $page) => $page
                    ->where('id', $this->author->id)
                    ->where('name', $this->author->name)
                    ->where('bio', $this->author->bio)
                    ->where('email', $this->author->email)
                    ->where('image', $this->author->image)
                    ->where('image_url', $this->author->image_url)
                    ->where('github_handle', $this->author->github_handle)
                    ->where('twitter_handle', $this->author->twitter_handle)
            )
    );
});

test('author can be updated', function () {
    $response = $this->loggedRequest->put('/admin/blog-author/'.$this->author->id, [
        'name' => 'New Name',
        'email' => 'new@email.com',
    ]);

    $response->assertRedirect('/admin/blog-author');

    $redirectResponse = $this->loggedRequest->get('/admin/blog-author');
    $redirectResponse->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogAuthor/AuthorIndex')
            ->has(
                'authors.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->author->id)
                    ->where('name', 'New Name')
                    ->where('email', 'new@email.com')
                    ->where('image_url', $this->author->image_url)
                    ->where('github_handle', $this->author->github_handle)
                    ->where('twitter_handle', $this->author->twitter_handle)
            )
    );
});

test('author can be deleted', function () {
    $response = $this->loggedRequest->delete('/admin/blog-author/'.$this->user->id);

    $response->assertRedirect('/admin/blog-author');

    $this->assertCount(0, Author::all());
});
