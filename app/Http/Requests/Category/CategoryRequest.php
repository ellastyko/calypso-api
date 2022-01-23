<?php

namespace App\Http\Requests\Category;
use \Illuminate\Foundation\Http\FormRequest;

abstract class CategoryRequest extends FormRequest
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
            'description' => ['string', 'max:500']
        ];
    }
}
