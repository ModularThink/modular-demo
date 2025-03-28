<?php

namespace Modules\Blog\Http\Requests;

use Modules\Support\Http\Requests\Request;

class CategoryValidate extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // Max size 2MB
            'is_visible' => 'required|boolean',
            'meta_tag_title' => 'nullable|string|max:60',
            'meta_tag_description' => 'nullable|string|max:160',
        ];
    }
}
