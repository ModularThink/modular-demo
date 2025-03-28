<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Blog\Models\Post;
use Modules\Blog\Services\Site\GetPostsFromArchive;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('get method returns posts from archive', function () {
    // Arrange
    $archiveDate = '02-2022';
    $startOfMonth = '2022-02-01 00:00:00';
    $endOfMonth = '2022-02-28 23:59:59';

    Post::factory()->create(['published_at' => '2022-02-01']);
    Post::factory()->create(['published_at' => '2022-01-01']);
    Post::factory()->create(['published_at' => '2021-12-01']);

    $expectedPosts = Post::with('tags')
        ->whereBetween('published_at', [$startOfMonth, $endOfMonth])
        ->latest()
        ->paginate(6);

    // Act
    $service = new GetPostsFromArchive;
    $posts = $service->get($archiveDate);

    // Assert
    $this->assertInstanceOf(LengthAwarePaginator::class, $posts);
    $this->assertEquals($expectedPosts->count(), $posts->count());
    $this->assertEquals($expectedPosts->toArray(), $posts->toArray());
});
