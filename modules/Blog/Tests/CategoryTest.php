<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Testing\AssertableInertia as Assert;
use Modules\Blog\Models\Category;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    Role::create(['name' => 'root']);
    $this->user->assignRole('root');

    $this->loggedRequest = $this->actingAs($this->user);

    $this->category = Category::factory()->create();
});

afterEach(function () {
    if ($this->category->image) {
        Storage::disk('public')->delete('blog/'.$this->category->image);
    }
});

test('category list can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/blog-category');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogCategory/CategoryIndex')
            ->has(
                'categories.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->category->id)
                    ->where('image_url', $this->category->image_url)
                    ->where('name', Str::limit($this->category->name, 50))
                    ->where('is_visible', $this->category->is_visible)
            )
    );
});

test('category create page can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/blog-category/create');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogCategory/CategoryForm')
    );
});

test('category can be created', function () {
    $response = $this->loggedRequest->post('/admin/blog-category', [
        'name' => 'Name',
        'description' => 'Description',
        'is_visible' => true,
        'meta_tag_title' => 'Meta Tag Title',
        'meta_tag_description' => 'Meta Tag Description',
    ]);

    $categories = Category::all();

    $response->assertRedirect('/admin/blog-category');
    $this->assertCount(2, $categories);
    $this->assertEquals('Name', $categories->last()->name);
});

test('category edit page can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/blog-category/'.$this->category->id.'/edit');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogCategory/CategoryForm')
            ->has(
                'category',
                fn (Assert $page) => $page
                    ->where('id', $this->category->id)
                    ->where('name', $this->category->name)
                    ->where('description', $this->category->description)
                    ->where('image', $this->category->image)
                    ->where('image_url', $this->category->image_url)
                    ->where('is_visible', $this->category->is_visible)
                    ->where('slug', $this->category->slug)
                    ->where('meta_tag_title', $this->category->meta_tag_title)
                    ->where('meta_tag_description', $this->category->meta_tag_description)
            )
    );
});

test('category can be updated', function () {
    $response = $this->loggedRequest->put('/admin/blog-category/'.$this->category->id, [
        'name' => 'New Name',
        'is_visible' => true,
    ]);

    $response->assertRedirect('/admin/blog-category');

    $redirectResponse = $this->loggedRequest->get('/admin/blog-category');
    $redirectResponse->assertInertia(
        fn (Assert $page) => $page
            ->component('BlogCategory/CategoryIndex')
            ->has(
                'categories.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->category->id)
                    ->where('name', 'New Name')
                    ->where('image_url', $this->category->image_url)
                    ->where('is_visible', true)
            )
    );
});

test('category can be deleted', function () {
    $response = $this->loggedRequest->delete('/admin/blog-category/'.$this->user->id);

    $response->assertRedirect('/admin/blog-category');

    $this->assertCount(0, Category::all());
});
