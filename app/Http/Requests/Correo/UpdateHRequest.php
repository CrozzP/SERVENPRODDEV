<?php

namespace App\Http\Requests\Correo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHRequest extends FormRequest
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
          
          'estado'=>'required|boolean'
          
          ];
    }

    public function messages(){
        return [

            'estado.required'=>'El estado es requerido',
            'estado.boolean'=>'El formato es incorrecto',

            
            
        ];
    }
}
