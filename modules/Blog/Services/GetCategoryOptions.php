<?php

namespace Modules\Blog\Services;

use Illuminate\Support\Str;
use Modules\Blog\Models\Category;

class GetCategoryOptions
{
    public function get(): array
    {
        return Category::orderBy('name')
            ->get()
            ->map(fn ($category) => [
                'value' => $category->id,
                'label' => Str::limit($category->name, 25),
            ])
            ->all();
    }
}
