<?php

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Blog\Models\Tag;
use Modules\Blog\Services\Site\GetTagOptions;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('it returns an array of tag options', function () {
    $tag = Tag::factory()->create();

    $tag->posts()->create([
        'title' => 'Test Post',
        'content' => 'Test Content',
        'published_at' => Carbon::now(),
    ]);

    // Call the get method
    $tagOptions = (new GetTagOptions)->get();

    // Assert that the tag options array is not empty
    $this->assertNotEmpty($tagOptions);

    // Assert that the tag options array contains the tag name and slug
    $this->assertEquals($tag->name, $tagOptions[0]['name']);
    $this->assertEquals($tag->slug, $tagOptions[0]['slug']);
});

test('it returns a default tag option when no tags are found', function () {
    // Create an instance of GetTagOptions
    $getTagOptions = new GetTagOptions;

    // Call the get method
    $tagOptions = $getTagOptions->get();

    // Assert that the tag options array contains the default tag option
    $this->assertEquals('No tags found', $tagOptions[0]['name']);
    $this->assertEquals('', $tagOptions[0]['slug']);
});
