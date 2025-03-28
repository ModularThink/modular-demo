<?php

namespace Modules\Blog\Services;

use Illuminate\Support\Str;
use Modules\Blog\Models\Tag;

class GetTagOptions
{
    public function get(): array
    {
        return Tag::orderBy('name')
            ->get()
            ->map(fn ($tag) => [
                'value' => $tag->id,
                'label' => Str::limit($tag->name, 25),
            ])
            ->all();
    }
}
