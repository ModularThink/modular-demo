<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Blog\Models\Post;
use Modules\Blog\Models\Tag;
use Modules\Blog\Services\SyncPostTags;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('sync method syncs tags with the post', function () {
    // Arrange
    $post = Post::factory()->create();
    $tag1 = Tag::factory()->create();
    $tag2 = Tag::factory()->create();
    $tags = [
        ['id' => $tag1->id],
        ['id' => $tag2->id],
    ];

    // Act
    (new SyncPostTags)->sync($post, $tags);

    // Assert
    $this->assertCount(2, $post->tags);
    $this->assertTrue($post->tags->contains($tag1));
    $this->assertTrue($post->tags->contains($tag2));
});

test('sync method detaches and syncs tags with the post', function () {
    // Arrange
    $post = Post::factory()->create();
    $tag1 = Tag::factory()->create();
    $tag2 = Tag::factory()->create();
    $tag3 = Tag::factory()->create();
    $post->tags()->attach([$tag1->id, $tag2->id]);

    $tags = [
        ['id' => $tag2->id],
        ['id' => $tag3->id],
    ];

    // Act
    (new SyncPostTags)->sync($post, $tags);

    // Assert
    $this->assertCount(2, $post->tags);
    $this->assertFalse($post->tags->contains($tag1));
    $this->assertTrue($post->tags->contains($tag2));
    $this->assertTrue($post->tags->contains($tag3));
});

test('sync method detaches all tags when no tags are provided', function () {
    // Arrange
    $post = Post::factory()->create();
    $tag1 = Tag::factory()->create();
    $tags = [
        ['id' => $tag1->id],
    ];
    (new SyncPostTags)->sync($post, $tags);

    // Act
    (new SyncPostTags)->sync($post, []);

    // Assert
    $this->assertCount(0, $post->tags);
});
