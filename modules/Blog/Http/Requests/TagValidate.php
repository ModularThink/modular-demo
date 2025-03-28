<?php

namespace Modules\Blog\Http\Requests;

use Modules\Support\Http\Requests\Request;

class TagValidate extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
