<?php

namespace App\Http\Requests\Extraordinario;

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
            //'personas_dni_id'=>'required',
            //'suministro_id'=>'required',
            //'direccion'=>'required',
            //'ruta'=>'required',
            'tipoExtraordinario_id'=>'required',
            'obsTipoExtraordinario_id'=>'required',
            //'fecha_inicio'=>'required',
            //'fecha_final'=>'required',
            'referencia'=>'required',
            //'users_id'=>'required',
            //'estado'=>'required',
            //'nestado'=>'required',

        ];
    }

    public function messages(){
        return [
            //'personas_dni_id.required' => 'El campo dni es requerido',
            //'suministro_id.unique' => 'El campo del suministro es requerido',
            //'direccion.required' => 'El campo de la direccion es requerido',
            //'ruta.required' => 'El campo de la ruta es requerido',
            'tipoExtraordinario_id.numeric' => 'Falta seleccionar una opcion',
            'obsTipoExtraordinario_id.numeric' => 'Especifique el tipo de servicio',

        ];
    }
}
