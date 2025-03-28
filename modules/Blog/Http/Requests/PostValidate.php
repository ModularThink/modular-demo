<?php

namespace Modules\Blog\Http\Requests;

use Modules\Support\Http\Requests\Request;

class PostValidate extends Request
{
    public function rules(): array
    {
        return [
            'blog_author_id' => 'nullable|exists:blog_authors,id',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'summary' => 'nullable|string|max:65535', // database text field size
            'image' => 'nullable|image|max:2048', // Max size 2MB
            'meta_tag_title' => 'nullable|string|max:60',
            'meta_tag_description' => 'nullable|string|max:160',
            'published_at' => 'nullable|date',
        ];
    }
}
