<?php

namespace App\Http\Requests\User;

use App\User;
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
        //return true;
        return $this->user()->can('create', User::class);
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => 'required|array',
            'name' => 'required|string|max:255',
            
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'sede_id' => 'required|array',
           // 'password' => 'required|string|min:8|confirmed',
            
        ];
    }

    public function messages(){
        return [
            'role.required' => 'Este campo rol es requerido',
            'role.array' => 'El valor de rol  es incorrecto',
            'name.required' => 'Falta agregar nombre',
            'name.string' => 'el valor no es correcto',
            'name.max' => 'Solo se permiten 255 caracteres',
            
            'email.required' => 'El email es requerido',
            'email.string' => 'El valor no es correcto',
            'email.max' => 'Solo se permiten 255 caracteres',
            'email.unique' => 'Este email ya esta registrado',
            'password.required' => 'Este campo es requerido',
            'password.string' => 'El valo no es correcto',
            'password.min' => 'Tu contraseña debe tener almenos 8 caracteres',
            //'password.confirmed' => 'la contraseña no coincide',
            'sede_id.required' => 'Seleccione una sede',
            'sede_id.array' => 'Formato incorrecto de la sede',

        ];
    }
}
