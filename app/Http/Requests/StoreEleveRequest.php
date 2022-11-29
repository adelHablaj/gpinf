<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEleveRequest extends FormRequest
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
            'massar'    =>  'required|unique:eleves,massar|regex:/(^[A-Za-z]{1}[0-9]{9}$)/u',
            'nom_ar'    =>  'required|min:2|max:20',
            'prenom_ar' =>  'required|min:2|max:20',
            'nom_fr'    =>  'required|min:2|max:20',
            'prenom_fr' =>  'required|min:2|max:20',
            'genre' => 'required|in:Féminin,Masculin',
            'date_nais' =>  'required|date',
            'avatar'    =>  'mimes:jpeg,png|size:200',
            // 'user_id'  =>  'required|integer',
            'niveau_id' =>  'required|integer',
            'date_inscription'  =>  'required|date',
            'prevenance'    =>  'required',
            'phone_urgence' =>  'required',
            'nationalite_id'    =>  'required|integer',
        ];
    }
}
