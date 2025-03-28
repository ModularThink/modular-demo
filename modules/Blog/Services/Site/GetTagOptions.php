<?php

namespace Modules\Blog\Services\Site;

use Carbon\Carbon;
use Modules\Blog\Models\Tag;

class GetTagOptions
{
    public function get(): array
    {
        $tags = Tag::whereHas('posts', function ($query) {
            $query->where('published_at', '<=', Carbon::now());
        })
            ->orderBy('name')
            ->get(['name', 'slug']);

        if ($tags->isEmpty()) {
            return [
                ['name' => 'No tags found', 'slug' => ''],
            ];
        }

        return $tags->toArray();
    }
}
