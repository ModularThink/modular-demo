<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Modules\Blog\Models\Tag;
use Modules\Blog\Services\GetTagOptions;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('get tag options', function () {
    // Create some tags
    $tag1 = Tag::factory()->create(['name' => 'Tag 1']);
    $tag2 = Tag::factory()->create(['name' => 'Tag 2']);
    $tag3 = Tag::factory()->create(['name' => 'Tag 3']);

    // Instantiate the GetTagOptions service
    $service = new GetTagOptions;

    // Call the get method
    $options = $service->get();

    // Assert that the options are correct
    $this->assertCount(3, $options);

    $this->assertEquals($tag1->id, $options[0]['value']);
    $this->assertEquals(Str::limit($tag1->name, 25), $options[0]['label']);

    $this->assertEquals($tag2->id, $options[1]['value']);
    $this->assertEquals(Str::limit($tag2->name, 25), $options[1]['label']);

    $this->assertEquals($tag3->id, $options[2]['value']);
    $this->assertEquals(Str::limit($tag3->name, 25), $options[2]['label']);
});
