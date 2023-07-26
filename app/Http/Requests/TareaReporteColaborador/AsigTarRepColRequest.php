<?php

namespace App\Http\Requests\TareaReporteColaborador;

use Illuminate\Foundation\Http\FormRequest;

class AsigTarRepColRequest extends FormRequest
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
            
         //'tareareporte_id' => 'unique:table,field,NULL,id,field1,value1,field2,value2,field3,value3'
         //'tareareporte_id' => 'unique:tareareportecolaborador,field,NULL,id,field1,value1,field2,value2,field3,value3'
         //'tareaReporte_id' => 'unique:mysql3.tareareportecolaborador,tareareporte_id,NULL,NULL,periodo_id,'.$this->periodoId,
         'tareaReporte_id' => 'unique:mysql3.tareareportecolaborador,tareareporte_id,NULL,NULL,periodo_id,'.$this->periodoId.',estado,1',
        ];
    }

    public function messages()
   {
       return [
          'tareaReporte_id.unique' => 'Ya existe un registro para el perido seleccionado',
         // 'price.required' => 'Añade un :attribute al producto',
         // 'price.min' => 'El :attribute debe ser mínimo 0'
       ];
   }
}
