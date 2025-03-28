<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Blog\Models\Post;
use Modules\Blog\Services\Site\GetArchiveOptions;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('get method returns archive options', function () {
    // Arrange
    Post::factory()->create(['published_at' => '2022-02-01']);
    Post::factory()->create(['published_at' => '2022-01-01']);
    Post::factory()->create(['published_at' => '2021-12-01']);

    $expectedOptions = [
        ['value' => '02-2022', 'label' => 'February (2022)'],
        ['value' => '01-2022', 'label' => 'January (2022)'],
        ['value' => '12-2021', 'label' => 'December (2021)'],
    ];

    // Act
    $options = (new GetArchiveOptions)->get();

    // Assert
    $this->assertCount(3, $options);
    $this->assertEquals($expectedOptions, $options);
});

test('get method returns "No posts found" when no posts are available', function () {
    // Act
    $options = (new GetArchiveOptions)->get();

    // Assert
    $this->assertCount(1, $options);
    $this->assertEquals('', $options[0]['value']);
    $this->assertEquals('No posts found', $options[0]['label']);
});
