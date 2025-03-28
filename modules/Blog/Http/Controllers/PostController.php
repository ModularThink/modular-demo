<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Modules\Blog\Http\Requests\PostValidate;
use Modules\Blog\Models\Post;
use Modules\Blog\Services\GetAuthorOptions;
use Modules\Blog\Services\GetCategoryOptions;
use Modules\Blog\Services\GetTagOptions;
use Modules\Blog\Services\SyncPostTags;
use Modules\Support\Http\Controllers\BackendController;
use Modules\Support\Traits\EditorImage;
use Modules\Support\Traits\UploadFile;

class PostController extends BackendController
{
    use EditorImage, UploadFile;

    protected string $uploadImagePath = 'blog';

    public function index(): Response
    {
        $posts = Post::orderBy('id', 'desc')
            ->search(request('searchContext'), request('searchTerm'))
            ->paginate(request('rowsPerPage', 10))
            ->withQueryString()
            ->through(fn ($post) => [
                'id' => $post->id,
                'image_url' => $post->image_url,
                'title' => $post->title,
                'status' => $post->status,
            ]);

        return inertia('BlogPost/PostIndex', [
            'posts' => $posts,
        ]);
    }

    public function create(GetCategoryOptions $getCategoryOptions, GetTagOptions $getTagOptions, GetAuthorOptions $getAuthorOptions): Response
    {
        return inertia('BlogPost/PostForm', [
            'categories' => $getCategoryOptions->get(),
            'tags' => $getTagOptions->get(),
            'authors' => $getAuthorOptions->get(),
        ]);
    }

    public function store(PostValidate $request, SyncPostTags $syncPostTags): RedirectResponse
    {
        $postData = $request->validated();

        if ($request->hasFile('image')) {
            $postData = array_merge($postData, $this->uploadFile('image', 'blog', 'originalUUID', 'public'));
        }

        $post = Post::create($postData);

        if (is_array($request->input('tags')) and count($request->input('tags'))) {
            $syncPostTags->sync($post, $request->input('tags'));
        }

        return redirect()->route('blogPost.index')
            ->with('success', 'Post created.');
    }

    public function edit(GetCategoryOptions $getCategoryOptions, GetTagOptions $getTagOptions, GetAuthorOptions $getAuthorOptions, int $id): Response
    {
        return inertia('BlogPost/PostForm', [
            'post' => Post::with(['tags' => function ($query) {
                $query->select('blog_tags.id', 'blog_tags.name');
            }])->find($id),
            'categories' => $getCategoryOptions->get(),
            'tags' => $getTagOptions->get(),
            'authors' => $getAuthorOptions->get(),
        ]);
    }

    public function update(PostValidate $request, SyncPostTags $syncPostTags, int $id): RedirectResponse
    {

        $post = Post::findOrFail($id);

        $postData = $request->validated();

        if ($request->hasFile('image')) {
            $postData = array_merge($postData, $this->uploadFile('image', 'blog', 'originalUUID', 'public'));
        } elseif ($request->input('remove_previous_image')) {
            $postData['image'] = null;
        } else {
            unset($postData['image']);
        }

        $post->update($postData);

        if ($request->has('tagsHasChanged')) {
            $syncPostTags->sync($post, $request->input('tags'));
        }

        return redirect()->route('blogPost.index')
            ->with('success', 'Post updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Post::findOrFail($id)->delete();

        return redirect()->route('blogPost.index')
            ->with('success', 'Post deleted.');
    }
}
