<?php

namespace App\Http\Requests\Role;

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
        $role = $this->route('role');
        return $this->user()->can('update', $role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'roleName' => 'required|unique:roles,roleName,' . $this->route('role')->id . '|max:255',
            'description' => 'required',
        ];
    }

    public function messages(){
        return [
            'roleName.required' => 'El campo de nombre es requerido',
            'roleName.unique' => 'El nombre ya esta ocupado',
            'description.required' => 'la opcion es requerida',
        ];
    }
}
