<?php

namespace App\Http\Requests\Permission;

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
        //return true;
        $permission = $this->route('permission');
        return $this->user()->can('update',$permission);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'permissionName' => 'required|unique:permissions,permissionName,' . $this->route('permission')->id . '|max:255',

            
            'description' => 'required',
            'role_id' => 'required|numeric',
        ];
    }

    public function messages(){
        return [
            'permissionName.required' => 'El campo de nombre es requerido',
            'permissionName.unique' => 'El nombre ya esta ocupado',
            'description.required' => 'la opcion es requerida',
            'role_id.required' => 'el campo del rol es requerido',
            'role_id.numeric' => 'el formato no es correcto',
        ];
    }
}
