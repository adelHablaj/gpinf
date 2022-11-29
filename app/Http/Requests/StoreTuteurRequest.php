<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTuteurRequest extends FormRequest
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
            'cin'    =>  'required|unique:tuteurs,cin,'.$this->id.'|regex:/(^[A-Za-z]+[0-9]+$)/u',
            'nom_ar'    =>  'required|min:2|max:20',
            'prenom_ar' =>  'required|min:2|max:20',
            'nom_fr'    =>  'required|min:2|max:20',
            'prenom_fr' =>  'required|min:2|max:20',
            'phone' =>  'required',
            'email' =>  'required|email',
            'adresse' =>  'required',
            'nationalite_id'    =>  'required|integer',
        ];
    }
}
