<?php

namespace Modules\Blog\Services;

use Illuminate\Support\Str;
use Modules\Blog\Models\Author;

class GetAuthorOptions
{
    public function get(): array
    {
        return Author::orderBy('name')
            ->get()
            ->map(fn ($author) => [
                'value' => $author->id,
                'label' => Str::limit($author->name, 25),
            ])
            ->all();
    }
}
