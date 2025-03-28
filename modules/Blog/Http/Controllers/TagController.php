<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Inertia\Response;
use Modules\Blog\Http\Requests\TagValidate;
use Modules\Blog\Models\Tag;
use Modules\Support\Http\Controllers\BackendController;
use Modules\Support\Traits\EditorImage;
use Modules\Support\Traits\UploadFile;

class TagController extends BackendController
{
    use EditorImage, UploadFile;

    public function index(): Response
    {
        $tags = Tag::orderBy('name')
            ->search(request('searchContext'), request('searchTerm'))
            ->paginate(request('rowsPerPage', 10))
            ->withQueryString()
            ->through(fn ($tag) => [
                'id' => $tag->id,
                'name' => Str::limit($tag->name, 50),
            ]);

        return inertia('BlogTag/TagIndex', [
            'tags' => $tags,
        ]);
    }

    public function create(): Response
    {
        return inertia('BlogTag/TagForm');
    }

    public function store(TagValidate $request): RedirectResponse
    {
        Tag::create($request->validated());

        return redirect()->route('blogTag.index')
            ->with('success', 'Tag created.');
    }

    public function edit(int $id): Response
    {
        $tag = Tag::find($id);

        return inertia('BlogTag/TagForm', [
            'tag' => $tag,
        ]);
    }

    public function update(TagValidate $request, int $id): RedirectResponse
    {
        $tag = Tag::findOrFail($id);

        $tag->update($request->validated());

        return redirect()->route('blogTag.index')
            ->with('success', 'Tag updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Tag::findOrFail($id)->delete();

        return redirect()->route('blogTag.index')
            ->with('success', 'Tag deleted.');
    }
}
