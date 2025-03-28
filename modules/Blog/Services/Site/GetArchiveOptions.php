<?php

namespace Modules\Blog\Services\Site;

use Carbon\Carbon;
use Modules\Blog\Models\Post;

class GetArchiveOptions
{
    public function get(): array
    {
        $posts = Post::whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now())
            ->get(['published_at']);

        if ($posts->isEmpty()) {
            return [['value' => '', 'label' => 'No posts found']];
        }

        $archiveDates = $posts->map(function ($post) {
            $date = Carbon::parse($post->published_at);
            $monthYear = $date->format('m-Y');
            $label = $date->format('F').' ('.$date->format('Y').')';

            return ['value' => $monthYear, 'label' => $label];
        });

        // Remove duplicates based on the 'value' property
        $uniqueArchiveDates = $archiveDates->unique('value')->values();

        // Sort by date descending
        $sortedArchiveDates = $uniqueArchiveDates->sortByDesc(function ($date) {
            return Carbon::createFromFormat('m-Y', $date['value']);
        })->values();

        return $sortedArchiveDates->toArray();
    }
}
