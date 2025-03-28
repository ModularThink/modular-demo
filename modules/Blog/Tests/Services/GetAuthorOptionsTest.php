<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Modules\Blog\Models\Author;
use Modules\Blog\Services\GetAuthorOptions;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('returns an array of author options', function () {
    // Arrange
    $author1 = Author::factory()->create(['name' => 'Alanis', 'email' => 'test22@test.com']);
    $author2 = Author::factory()->create(['name' => 'Beatrice', 'email' => 'test23@test.com']);
    $getAuthorOptions = new GetAuthorOptions;

    // Act
    $options = $getAuthorOptions->get();

    // Assert
    expect($options)->toBeArray();
    expect($options)->toHaveCount(2);
    expect($options[0])->toHaveKeys(['value', 'label']);
    expect($options[0]['value'])->toBe($author1->id);
    expect($options[0]['label'])->toBe(Str::limit($author1->name, 25));
    expect($options[1])->toHaveKeys(['value', 'label']);
    expect($options[1]['value'])->toBe($author2->id);
    expect($options[1]['label'])->toBe(Str::limit($author2->name, 25));
});
