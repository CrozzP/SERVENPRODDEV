<?php

namespace App\Http\Requests\Aula;

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
            'nameAula'  =>'required|string',
            'activo'    =>'required|bool',
            'capacidad' =>'required|numeric|min:0|max:50',
            'area_id'   =>'required|numeric',
            'sede_id'   =>'required|numeric',
            'turno_id'  =>'required|numeric',
            'local_id'  =>'required|numeric',


            
        ];
    }

    public function messages(){
        return [
            'nameAula.required' => 'Nombre del aula requerido',
            'nameAula.string' => 'El valor nombre del aula no es correcto',

            'activo.' => 'estado del aula requerido',
            'activo.bool' => 'El valor activo no es correcto',

            'capacidad.required' => 'Capacidad requerido',
            'capacidad.numeric' => 'El valor capacidad no es correcto',
            'capacidad.min' => 'Solo se permiten entre 0 - 50',
            'capacidad.max' => 'Solo se permiten entre 0 - 50',

            'area_id.required' => 'Area requerido',
            'area_id.numeric' => 'El valor area no es correcto',

            'sede_id.required' => 'Sede requerido',
            'sede_id.numeric' => 'El valor sede no es correcto',

            'turno_id.required' => 'Turo requerido',
            'turno_id.numeric' => 'El valor turno no es correcto',

            'local_id.required' => 'Local requerido',
            'local_id.numeric' => 'El valor local no es correcto',

            
        ];
    }
}
