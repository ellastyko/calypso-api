<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['string', 'max:255'],
            'content' => ['string', 'max:10000'],
            'category' => ['array'],
            'category.*' => ['int', 'min:1']
        ];
    }
}
