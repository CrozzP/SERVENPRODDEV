<?php

namespace App\Http\Requests\Correo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
          
          'correo'=>'required|email|unique:correo',
          
          'correoNombre'=>'required|string',
          'cargo'=>'required|string',
          'empresa_id'=>'required|numeric',
          ];
    }

    public function messages(){
        return [

            'correo.required'=>'El correo es requerido',
            'correo.email'=>'El correo debe tener el formato de email',
            'correo.unique'=>'El correo ya existe',
            
            'correoNombre.required'=>'Titular del correo es requerido',
            'correoNombre.string'=>'Formato del titular incorrecto',
            'cargo.required'=>'El cargo es requerido',
            'cargo.string'=>'Formato del cargo es incorrecto',
            'empresa_id.required'=>'La empresa es requerida',
            'empresa_id.numeric'=>'Formato de l empresa es incorrecto',
            
        ];
    }
}
