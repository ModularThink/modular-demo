<?php

namespace Modules\Blog\Services\Site;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Blog\Models\Post;

class GetPostsFromArchive
{
    public function get(string $archiveDate): LengthAwarePaginator
    {
        $archiveDateCarbon = Carbon::createFromFormat('m-Y', $archiveDate);
        $startOfMonth = $archiveDateCarbon->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = $archiveDateCarbon->endOfMonth()->format('Y-m-d H:i:s');

        $posts = Post::with('tags')
            ->whereBetween('published_at', [$startOfMonth, $endOfMonth])
            ->latest()
            ->paginate(6);

        return $posts;
    }
}
