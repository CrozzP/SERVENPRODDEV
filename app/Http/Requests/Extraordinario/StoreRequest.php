<?php

namespace App\Http\Requests\Extraordinario;

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
          //  'personaDni'=>'required|max:8|min:8',
            'suministroCodigoSuministro'=>'required',
           
           // 'ruta'=>'required',
            //'tipoExtraordinario_id'=>'required',
            'obsTipoExtraordinario_id'=>'required|integer',
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
           // 'personaDni.required' => 'El campo dni es requerido',
          //  'personaDni.max' => 'Falta DNI del Solicitante',
          //  'personaDni.min' => 'Falta DNI del Solicitante',
            'suministroCodigoSuministro.unique' => 'El campo del suministro es requerido',
           // 'tipoExtraordinario_id.required' => 'El campo Tipo de registro es obligatorio',
            'obsTipoExtraordinario_id.required' => 'El campo Descripcion de Registro es obligatorio',
            'obsTipoExtraordinario_id.integer' => 'El campo Descripcion de Registro es obligatorio',
            'direccion.required' => 'El campo de la direccion es requerido',
          //  'ruta.required' => 'El campo de la ruta es requerido',

        ];
    }
}
