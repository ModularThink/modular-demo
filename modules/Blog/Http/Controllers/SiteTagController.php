<?php

namespace Modules\Blog\Http\Controllers;

use Carbon\Carbon;
use Illuminate\View\View;
use Modules\Blog\Models\Post;
use Modules\Blog\Models\Tag;
use Modules\Blog\Services\Site\GetArchiveOptions;
use Modules\Blog\Services\Site\GetTagOptions;
use Modules\Support\Http\Controllers\SiteController;

class SiteTagController extends SiteController
{
    public function index(GetArchiveOptions $getArchiveOptions, GetTagOptions $getTagOptions, string $tagSlug): View
    {
        $posts = Post::with('tags')
            ->whereHas('tags', function ($query) use ($tagSlug) {
                $query->where('slug', $tagSlug);
            })
            ->where('published_at', '<=', Carbon::now())
            ->latest()
            ->paginate(6);

        $archiveOptions = $getArchiveOptions->get();
        $tag = Tag::where('slug', $tagSlug)->first();

        $tags = $getTagOptions->get();

        return view('blog::post-index', [
            'posts' => $posts,
            'archiveOptions' => $archiveOptions,
            'tags' => $tags,
            'fromTag' => $tag ? $tag->name : null,
        ]);
    }
}
