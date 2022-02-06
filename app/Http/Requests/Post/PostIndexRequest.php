<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\IndexRequest;

class PostIndexRequest extends IndexRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [

        ]);
    }
}
