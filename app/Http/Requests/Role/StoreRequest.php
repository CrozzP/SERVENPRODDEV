<?php

namespace App\Http\Requests\Role;

use App\Role;
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
        //dd($this->user()->can('create', Role::class));
        return $this->user()->can('create', Role::class);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'roleName' => 'required|unique:roles|max:255',
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
