<?php

namespace App\Http\Requests\Persona;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            
            'dni' =>'required|string|max:8|unique:personas',
            'nombre' =>'required|string',
            'apellPat' =>'required|string',
            'apellMat' =>'required|string',
            'sexo' =>'required',
            'fechaNacimiento' =>'required|date',
            'direccion' =>'required|string',
            'telefono' =>'required',
            'email' =>'required|email|unique:personas',
            'departamento_id' =>'required|numeric',
            'provincia_id' =>'required|numeric',
            'distrito_id' =>'required|numeric',
            
        ];
    }

    public function messages(){
        return [
            'dni.required' => 'dni requerido',
            'nombre.required' => 'nombres requerido',
            'apellPat.required' => 'apellPat requerido',
            'apellMat.required' => 'apellMat requerido',
            'sexo.required' => 'sexo requerido',
            'fechaNacimiento.required' => 'fechaNacimiento requerido',
            'direccion.required' => 'direccion requerido',
            'telefono.required' => 'telefono requerido',
            'email.required' => 'email requerido',
            'departamento_id.required' => 'departamento_id requerido',
            'provincia_id.required' => 'provincia_id requerido',
            'distrito_id.required' => 'distrito_id requerido',
            
            'dni.string' => 'El valor no es correcto',
            'nombre.string' => 'El valor no es correcto',
            'apellPat.string' => 'El valor no es correcto',
            'apellMat.string' => 'El valor no es correcto',
            'direccion.string' => 'El valor no es correcto',
            
            'departamento_id.numeric' => 'El valor es numerico',
            'provincia_id.numeric' => 'El valor es numerico',
            'distrito_id.numeric' => 'El valor es numerico',
            
            'dni.max' => 'Solo se permiten 8 caracteres',

            'email.unique' => 'Este email ya esta registrado',
            'dni.unique' => 'Este dni ya esta registrado',

            
            

        ];
    }
}
