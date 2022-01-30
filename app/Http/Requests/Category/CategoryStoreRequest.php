<?php

namespace App\Http\Requests\Category;

use App\Models\Post;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
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
