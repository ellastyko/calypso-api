<?php

namespace App\Http\Requests\Category;

class CategoryStoreRequest extends CategoryRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // false
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255',  'unique:categories,title'],
            'description' => ['required', 'string', 'max:500']
        ];
    }
}
