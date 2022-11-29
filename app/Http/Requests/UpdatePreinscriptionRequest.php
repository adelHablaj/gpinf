<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePreinscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom_fr' => 'required|min:2|max:100',
            'prenom_fr' => 'required|min:2|max:100',
            'nom_ar' => 'required|min:2|max:200',
            'prenom_ar' => 'required|min:2|max:200',
            'age' => 'required|gte:4|lte:16'
        ];
    }
}
