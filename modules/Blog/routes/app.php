<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\AuthorController;
use Modules\Blog\Http\Controllers\CategoryController;
use Modules\Blog\Http\Controllers\PostController;
use Modules\Blog\Http\Controllers\TagController;

// Posts
Route::post('blog-post/upload-editor-image', [
    PostController::class, 'uploadEditorImage',
])
    ->name('blogPost.uploadEditorImage')
    ->can('Blog: Post - Create')
    ->can('Blog: Post - Edit');

Route::get('blog-post', [
    PostController::class, 'index',
])
    ->name('blogPost.index')
    ->can('Blog: Post - List');

Route::get('blog-post/create', [
    PostController::class, 'create',
])
    ->name('blogPost.create')
    ->can('Blog: Post - Create');

Route::post('blog-post', [
    PostController::class, 'store',
])
    ->name('blogPost.store')
    ->can('Blog: Post - Create');

Route::get('blog-post/{id}/edit', [
    PostController::class, 'edit',
])
    ->name('blogPost.edit')
    ->can('Blog: Post - Edit');

Route::put('blog-post/{id}', [
    PostController::class, 'update',
])
    ->name('blogPost.update')
    ->can('Blog: Post - Edit');

Route::delete('blog-post/{id}', [
    PostController::class, 'destroy',
])
    ->name('blogPost.destroy')
    ->can('Blog: Post - Delete');

// Categories
Route::post('blog-category/upload-editor-image', [
    CategoryController::class, 'uploadEditorImage',
])
    ->name('blogCategory.uploadEditorImage')
    ->can('Blog: Category - Create')
    ->can('Blog: Category - Edit');

Route::get('blog-category', [
    CategoryController::class, 'index',
])
    ->name('blogCategory.index')
    ->can('Blog: Category - List');

Route::get('blog-category/create', [
    CategoryController::class, 'create',
])
    ->name('blogCategory.create')
    ->can('Blog: Category - Create');

Route::post('blog-category', [
    CategoryController::class, 'store',
])
    ->name('blogCategory.store')
    ->can('Blog: Category - Create');

Route::get('blog-category/{id}/edit', [
    CategoryController::class, 'edit',
])
    ->name('blogCategory.edit')
    ->can('Blog: Category - Edit');

Route::put('blog-category/{id}', [
    CategoryController::class, 'update',
])
    ->name('blogCategory.update')
    ->can('Blog: Category - Edit');

Route::delete('blog-category/{id}', [
    CategoryController::class, 'destroy',
])
    ->name('blogCategory.destroy')
    ->can('Blog: Category - Delete');

// Tags
Route::get('blog-tag', [
    TagController::class, 'index',
])
    ->name('blogTag.index')
    ->can('Blog: Tag - List');

Route::get('blog-tag/create', [
    TagController::class, 'create',
])
    ->name('blogTag.create')
    ->can('Blog: Tag - Create');

Route::post('blog-tag', [
    TagController::class, 'store',
])
    ->name('blogTag.store')
    ->can('Blog: Tag - Create');

Route::get('blog-tag/{id}/edit', [
    TagController::class, 'edit',
])
    ->name('blogTag.edit')
    ->can('Blog: Tag - Edit');

Route::put('blog-tag/{id}', [
    TagController::class, 'update',
])
    ->name('blogTag.update')
    ->can('Blog: Tag - Edit');

Route::delete('blog-tag/{id}', [
    TagController::class, 'destroy',
])
    ->name('blogTag.destroy')
    ->can('Blog: Tag - Delete');

// Authors
Route::get('blog-author', [
    AuthorController::class, 'index',
])
    ->name('blogAuthor.index')
    ->can('Blog: Author - List');

Route::get('blog-author/create', [
    AuthorController::class, 'create',
])
    ->name('blogAuthor.create')
    ->can('Blog: Author - Create');

Route::post('blog-author', [
    AuthorController::class, 'store',
])
    ->name('blogAuthor.store')
    ->can('Blog: Author - Create');

Route::get('blog-author/{id}/edit', [
    AuthorController::class, 'edit',
])
    ->name('blogAuthor.edit')
    ->can('Blog: Author - Edit');

Route::put('blog-author/{id}', [
    AuthorController::class, 'update',
])
    ->name('blogAuthor.update')
    ->can('Blog: Author - Edit');

Route::delete('blog-author/{id}', [
    AuthorController::class, 'destroy',
])
    ->name('blogAuthor.destroy')
    ->can('Blog: Author - Delete');
