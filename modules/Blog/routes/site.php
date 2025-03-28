<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\SiteArchiveController;
use Modules\Blog\Http\Controllers\SitePostController;
use Modules\Blog\Http\Controllers\SitePostSearchController;
use Modules\Blog\Http\Controllers\SiteTagController;

Route::get('/blog/archive/{archiveDate}', [
    SiteArchiveController::class,
    'index',
]);

Route::get('/blog/tag/{tagSlug}', [
    SiteTagController::class,
    'index',
]);

Route::get('/blog/search/{searchTerm}', [
    SitePostSearchController::class,
    'index',
]);

Route::get('/blog', [
    SitePostController::class,
    'index',
]);

Route::get('/blog/{slug}', [
    SitePostController::class,
    'show',
]);
