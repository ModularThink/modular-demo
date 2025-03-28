<?php

namespace Modules\Blog\Http\Controllers;

use Carbon\Carbon;
use Illuminate\View\View;
use Modules\Blog\Models\Post;
use Modules\Blog\Services\Site\GetArchiveOptions;
use Modules\Blog\Services\Site\GetTagOptions;
use Modules\Support\Http\Controllers\SiteController;

class SitePostController extends SiteController
{
    public function index(GetArchiveOptions $getArchiveOptions, GetTagOptions $getTagOptions): View
    {
        $posts = Post::with('tags', 'author')
            ->where('published_at', '<=', Carbon::now())
            ->latest()
            ->paginate(6);

        $archiveOptions = $getArchiveOptions->get();
        $tags = $getTagOptions->get();

        return view('blog::post-index', compact('posts', 'archiveOptions', 'tags'));
    }

    public function show($slug)
    {
        $post = Post::with('author')->where('slug', $slug)->first();

        return view('blog::post-show', compact('post'));
    }
}
