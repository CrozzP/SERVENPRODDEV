<?php

namespace App\Http\Requests\Persona;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegEstRequest extends FormRequest
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
        

        $rules = [

            "image" => "required|image|mimes:jpeg,png",
            //"archivo" => "mimes:pdf",
            'tipoDescuento_id' =>'numeric',

            
            
            'personaEst_dni' =>'required|string|max:8|min:8|unique:personas,dni',
            'personaEst_nombre' =>'required|string',
            'personaEst_apellPat' =>'required|string',
            'personaEst_apellMat' =>'required|string',
            'personaEst_sexo' =>'required',
            'personaEst_fechaNacimiento' =>'required|date',
            'personaEst_direccion' =>'required|string',
            'personaEst_telefono' =>'required',
            'personaEst_email' =>'required|email|unique:personas,email',
            'personaEst_departamento_id' =>'required|numeric',
            'personaEst_provincia_id' =>'required|numeric',
            'personaEst_distrito_id' =>'required|numeric',

            'estudiante_añoEgreso' =>'required|numeric',
            'estudiante_aula_id' =>'required|numeric',
            'estudiante_colegio_id' =>'required|numeric',

            'pago_dni' =>'required|string|max:8|min:8',
            'pago_serie' =>'required|string|max:7|min:7',
            'pago_fecha' =>'required|date',
            'pago_importe' =>'required',
            'pago_tipoPago_id' =>'required|numeric',
            'pago_dniserie' =>'required|unique:boucherPagos,dniserie',
            
            'personaApo_dni' =>'required|string|max:8|min:8',
            'personaApo_nombre' =>'required|string',
            'personaApo_apellPat' =>'required|string',
            'personaApo_apellMat' =>'required|string',
            'personaApo_sexo' =>'required',
            'personaApo_fechaNacimiento' =>'required|date',
            'personaApo_telefono' =>'required',
            'personaApo_departamento_id' =>'required|numeric',
            'personaApo_provincia_id' =>'required|numeric',
            'personaApo_distrito_id' =>'required|numeric',

            'personaApo_tipoApoderado_id' =>'required|numeric',




            
        ];
      //  dd($this->get('referencia'));
        $tipoDescuento_id = $this->get('tipoDescuento_id');
        //dd($tipoDescuento_id);
//dd($this->get('archivo'));
//dd(is_null('archivo'));
        if($this->get('archivo') && is_null('archivo') && $tipoDescuento_id ==1){
        //if(!empty('archivo')){
        return $rules;
    }else if(!$this->get('archivo') && $tipoDescuento_id ==2){
        $rules = array_merge($rules, ['archivo' => 'required|mimes:pdf','referencia' => 'exists:estudiantes,id','hermano_hermano' => 'required',]);
        return $rules;
    }else if(!$this->get('archivo') && $tipoDescuento_id >2){
        $rules = array_merge($rules, ['archivo' => 'required|mimes:pdf','hermano_hermano' => 'required',]);
        return $rules;
    }else 
    return $rules;
       
/*
        if($this->get('archivo') && !empty('archivo'))
        {
        $rules = array_merge($rules, ['archivo' => 'mimes:pdf']);
        return $rules;
        }else
        return $rules;*/

    }

    public function messages(){
        return [

            'image.required' => 'La imagen es requerida',
            'image.image' => 'El archivo tiene que ser una imagen',
            'image.mimes' => 'El archivo debe ser en (jpeg, png)',
            'archivo.required' => 'El archivo es requerido',
            'archivo.mimes' => 'El archivo debe ser en (pdf)',
            'hermano_hermano.required' => 'La referencia es requerida',
            
            
            'referencia.exists' => 'El estudiante no existe/ no esta matriculado',

           

            
            'tipoDescuento_id.numeric' => 'El valor es numerico',

            'personaEst_dni.required' => 'El dni del estudiante es requerido',
            'personaEst_nombre.required' => 'El nombres del estudiante requerido',
            'personaEst_apellPat.required' => 'El apellPat del estudiante es requerido',
            'personaEst_apellMat.required' => 'El apellMat del estudiante es requerido',
            'personaEst_sexo.required' => 'El sexo del estudiante  del estudiante es requerido',
            'personaEst_fechaNacimiento.required' => 'La fechaNacimiento del estudiante es requerido',
            'personaEst_direccion.required' => 'La direccion  del estudiante es requerido',
            'personaEst_telefono.required' => 'El telefono  del estudiante es requerido',
            'personaEst_email.required' => 'El email  del estudiante es requerido',
            'personaEst_departamento_id.required' => 'El departamento_id  del estudiante es requerido',
            'personaEst_provincia_id.required' => 'La provincia_id  del estudiante es requerido',
            'personaEst_distrito_id.required' => 'El distrito_id  del estudiante es requerido',
            'personaEst_dni.string' => 'El valor no es correcto',
            'personaEst_nombre.string' => 'El valor no es correcto',
            'personaEst_apellPat.string' => 'El valor no es correcto',
            'personaEst_apellMat.string' => 'El valor no es correcto',
            'personaEst_direccion.string' => 'El valor no es correcto',
            'personaEst_departamento_id.numeric' => 'El valor es numerico',
            'personaEst_provincia_id.numeric' => 'El valor es numerico',
            'personaEst_distrito_id.numeric' => 'El valor es numerico',
            'personaEst_dni.max' => 'Solo se permiten 8 caracteres',
            'personaEst_dni.min' => 'Solo se permiten 8 caracteres',
            'personaEst_email.unique' => 'Este email ya esta registrado',
            'personaEst_dni.unique' => 'El dni del estudiante ya esta registrado - CONTACTARSE CON EL AREA DE COMPUTO',

            'estudiante_añoEgreso.required' => 'Año de egreso requerido',
            'estudiante_añoEgreso.numeric' => 'El valor es numerico',
            'estudiante_aula_id.required' => 'El aula es requerido',
            'estudiante_aula_id.numeric' => 'El valor es numerico',
            'estudiante_colegio_id.required' => 'El colegio es requerido',
            'estudiante_colegio_id.numeric' => 'El valor es numerico',

            'pago_dni.required' => 'El dni del boucher es requerido',
            'pago_dni.string' => 'El valor no es correcto',
            'pago_dni.max' => 'Solo se permiten 8 caracteres',
            'pago_dni.min' => 'Solo se permiten 8 caracteres',
            'pago_serie.required' => 'La serie del boucher es requerido',
            'pago_serie.string' => 'El valor no es correcto',
            'pago_serie.max' => 'Solo se permiten 7 caracteres',
            'pago_serie.min' => 'Solo se permiten 7 caracteres',
            'pago_fecha.required' => 'La fecha del boucher es requerido',
            'pago_fecha.date' => 'No es el formato requerido',
            'pago_importe.required' => 'El importe del boucher es requerido',
            'pago_tipoPago_id.required' => 'El tipo de pago es requerido',
            'pago_tipoPago_id.numeric' => 'El valor es numerico',
            'pago_dniserie.required' => 'El boucher es requerido',
            'pago_dniserie.unique' => 'Este boucher ya esta registrado',

            'personaApo_dni.required' => 'dni requerido',
            'personaApo_nombre.required' => 'nombres requerido',
            'personaApo_apellPat.required' => 'apellPat requerido',
            'personaApo_apellMat.required' => 'apellMat requerido',
            'personaApo_sexo.required' => 'sexo requerido',
            'personaApo_fechaNacimiento.required' => 'fechaNacimiento requerido',
            'personaApo_telefono.required' => 'telefono requerido',
            'personaApo_departamento_id.required' => 'departamento_id requerido',
            'personaApo_provincia_id.required' => 'provincia_id requerido',
            'personaApo_distrito_id.required' => 'distrito_id requerido',
            'personaApo_dni.string' => 'El valor no es correcto',
            'personaApo_nombre.string' => 'El valor no es correcto',
            'personaApo_apellPat.string' => 'El valor no es correcto',
            'personaApo_apellMat.string' => 'El valor no es correcto',
            'personaApo_departamento_id.numeric' => 'El valor es numerico',
            'personaApo_provincia_id.numeric' => 'El valor es numerico',
            'personaApo_distrito_id.numeric' => 'El valor es numerico',
            'personaApo_dni.max' => 'Solo se permiten 8 caracteres',
            'personaApo_dni.min' => 'Solo se permiten 8 caracteres',
            'personaApo_dni.unique' => 'Este dni ya esta registrado',


            'personaApo_tipoApoderado_id.required' => 'El tipo de apoderado es requerido',
            'personaApo_tipoApoderado_id.numeric' => 'El valor es numerico',

            
            

        ];
    }
}
