<?php

namespace App\Http\Requests\Post;

class PostStoreRequest extends PostRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:10000'],
            'category' => ['required', 'array'],
            'category.*' => ['required', 'int', 'min:1']
        ];
    }
}
