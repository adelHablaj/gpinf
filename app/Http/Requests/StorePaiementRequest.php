<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaiementRequest extends FormRequest
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
        // dd($this);
        return [
            'label' => 'required|min:10',
            'date'  => 'required|date',
            'montant'   => 'required|numeric',
            'mode'  =>  'required|in:Chèque,Espèce',
            'date_echeance' => 'exclude_if:mode,Espèce|required|date',
            'eleve_id' => 'required|numeric',
        ];
    }
}
