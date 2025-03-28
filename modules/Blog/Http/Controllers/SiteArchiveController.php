<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\View\View;
use Modules\Blog\Services\Site\GetArchiveOptions;
use Modules\Blog\Services\Site\GetPostsFromArchive;
use Modules\Blog\Services\Site\GetTagOptions;
use Modules\Support\Http\Controllers\SiteController;

class SiteArchiveController extends SiteController
{
    public function index(GetArchiveOptions $getArchiveOptions, GetTagOptions $getTagOptions, GetPostsFromArchive $getPostsFromArchive, string $archiveDate): View
    {
        $posts = $getPostsFromArchive->get($archiveDate);

        $archiveOptions = $getArchiveOptions->get();
        $tags = $getTagOptions->get();

        return view('blog::post-index', [
            'posts' => $posts,
            'archiveOptions' => $archiveOptions,
            'tags' => $tags,
            'fromArchive' => $archiveDate,
        ]);
    }
}
