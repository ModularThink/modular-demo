<?php

namespace Modules\Blog;

use Modules\Blog\Models\Post;
use Modules\Blog\Observers\PostObserver;
use Modules\Support\BaseServiceProvider;

class BlogServiceProvider extends BaseServiceProvider
{
    protected $namespace = 'Modules\Blog\Http\Controllers';

    public function boot()
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'blog');

        Post::observe(PostObserver::class);
    }
}
