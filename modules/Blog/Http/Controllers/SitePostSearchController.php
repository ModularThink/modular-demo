<?php

namespace Modules\Blog\Http\Controllers;

use Carbon\Carbon;
use Illuminate\View\View;
use Modules\Blog\Models\Post;
use Modules\Blog\Services\Site\GetArchiveOptions;
use Modules\Blog\Services\Site\GetTagOptions;
use Modules\Support\Http\Controllers\SiteController;

class SitePostSearchController extends SiteController
{
    public function index(GetArchiveOptions $getArchiveOptions, GetTagOptions $getTagOptions, string $searchTerm): View
    {
        $posts = Post::with('tags')
            ->where('published_at', '<=', Carbon::now())
            ->search('title,content', $searchTerm)
            ->latest()
            ->paginate(6);

        $archiveOptions = $getArchiveOptions->get();
        $tags = $getTagOptions->get();

        $fromSearch = $searchTerm;

        return view('blog::post-index', compact('posts', 'archiveOptions', 'tags', 'fromSearch'));
    }

    public function show($slug): View
    {
        $post = Post::where('slug', $slug)->first();

        return view('blog::post-show', compact('post'));
    }
}
