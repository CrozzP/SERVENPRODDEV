<?php

namespace App\Http\Requests\Persona;

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
            
            //'dni' =>'required|string|max:8|unique:personas,dni,'. $this->route('persona')->id.'',
            //'dni' =>'required|string|max:8|unique:personas,dni',

            'nombre' =>'required|string',
            'apellPat' =>'required|string',
            'apellMat' =>'required|string',
            'sexo' =>'required',
            //'fechaNacimiento' =>'required|date',
            //'direccion' =>'required|string',
            //'telefono' =>'required',
            //'email' => 'required|string|email|unique:personas,email,'. $this->route('persona')->id.'|max:255',
            
            
        ];
    }


      public function messages(){
        return [
            //'dni.required' => 'dni requerido',
            'nombre.required' => 'nombres requerido',
            'apellPat.required' => 'apellPat requerido',
            'apellMat.required' => 'apellMat requerido',
            'sexo.required' => 'sexo requerido',
            //'fechaNacimiento.required' => 'fechaNacimiento requerido',
            //'direccion.required' => 'direccion requerido',
            //'telefono.required' => 'telefono requerido',
            //'email.required' => 'email requerido',
            
            
            //'dni.string' => 'El valor no es correcto',
            'nombre.string' => 'El valor no es correcto',
            'apellPat.string' => 'El valor no es correcto',
            'apellMat.string' => 'El valor no es correcto',
            //'direccion.string' => 'El valor no es correcto',
            
                        
           // 'dni.max' => 'Solo se permiten 8 caracteres',

            //'email.unique' => 'Este email ya esta registrado',
            //'dni.unique' => 'Este dni ya esta registrado',

            
            

        ];
    }
}
