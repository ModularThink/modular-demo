<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Modules\Blog\Models\Category;
use Modules\Blog\Services\GetCategoryOptions;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('returns an array of category options', function () {
    // Arrange
    $category1 = Category::factory()->create(['name' => 'Category 1']);
    $category2 = Category::factory()->create(['name' => 'Category 2']);
    $getCategoryOptions = new GetCategoryOptions;

    // Act
    $options = $getCategoryOptions->get();

    // Assert
    expect($options)->toBeArray();
    expect($options)->toHaveCount(2);
    expect($options[0])->toHaveKeys(['value', 'label']);
    expect($options[0]['value'])->toBe($category1->id);
    expect($options[0]['label'])->toBe(Str::limit($category1->name, 25));
    expect($options[1])->toHaveKeys(['value', 'label']);
    expect($options[1]['value'])->toBe($category2->id);
    expect($options[1]['label'])->toBe(Str::limit($category2->name, 25));
});
