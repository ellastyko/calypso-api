<?php

namespace App\Http\Requests\Post;

use App\Enum\PostStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostStoreRequest extends FormRequest
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
            'status'  => [
                'required',
                'int',
                Rule::in([PostStatus::DRAFT, PostStatus::PUBLISHED])
            ],
            'categories_id' => ['required'],
            'categories_id.*' => ['required', 'int', 'min:1', 'exists:categories,id']
        ];
    }
}
