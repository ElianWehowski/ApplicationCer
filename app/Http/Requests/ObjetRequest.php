<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObjetRequest extends FormRequest
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
            'prix'=>'',
            'proprietaire'=>'numeric',
            'acheteur'=>'numeric',
            'nom'=>'String',
            'categorie'=>'numeric',
            'dateOuverture'=>'date',
            'dateFermeture'=>'date',
            'vendu'=>'min:0|max:1   ',
        ];
    }
}
