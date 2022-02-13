<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'per_page' => ['int', 'in:5,10,20,50,100'],
            'order' => ['string', 'in:created,votes'],
            'direction' => ['string', 'in:asc,desc']
        ];
    }
}
