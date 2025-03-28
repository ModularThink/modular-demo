<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Support\Http\Requests\Request;

class AuthorValidate extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('blog_authors', 'email')->ignore(request('id')),
            ],
            'image' => 'nullable|image|max:2048', // Max size 2MB
            'bio' => 'nullable|string',
            'github_handle' => 'nullable|string|max:255',
            'twitter_handle' => 'nullable|string|max:255',
        ];
    }
}
