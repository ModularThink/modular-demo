<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Modules\Blog\Models\Post;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->post = Post::factory()->create([
        'title' => 'Test Post',
        'content' => 'Test Content',
        'published_at' => now()->subDay(),
    ]);
});

afterEach(function () {
    if ($this->post->image) {
        Storage::disk('public')->delete('blog/'.$this->post->image);
    }
});

test('blog index page can be rendered', function () {
    $this->withoutVite();
    $response = $this->get('/blog');

    $response->assertStatus(200);
    $response->assertSee('Blog');
    $response->assertSee($this->post->title);
});

test('blog post page can be rendered', function () {
    $this->withoutVite();
    $response = $this->get('/blog/'.$this->post->slug);

    $response->assertStatus(200);
    $response->assertSee($this->post->title);
    $response->assertSee($this->post->content);
});
