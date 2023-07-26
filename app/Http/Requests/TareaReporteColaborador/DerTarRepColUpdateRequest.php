<?php

namespace App\Http\Requests\TareaReporteColaborador;

use Illuminate\Foundation\Http\FormRequest;

class DerTarRepColUpdateRequest extends FormRequest
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
      
      //dd('dentro de reglas',$this->request);
        return [
            
        // 'trc_tareareporte_id' => 'unique:mysql3.tareareportecolaborador,tareareporte_id,NULL,NULL,periodo_id,'.$this->trc_periodo_id.',empresacolaborador_id,'.$this->colaborador_id,
         'motivo_id'=>'required',
        ];
    }

    public function messages()
   {
       return [
         // 'trc_tareareporte_id.unique' => 'No puede seleccionar a un COLABORADOR anteriormente asignado',
          'motivo_id.required'=>'El motivo es obligatorio',
         // 'price.required' => 'Añade un :attribute al producto',
         // 'price.min' => 'El :attribute debe ser mínimo 0'
       ];
   }
}
