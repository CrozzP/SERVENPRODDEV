<?php

namespace App\Http\Requests\Persona;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

class StoreSolRequest extends FormRequest
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
    public function rules(Request $request)
    {
        //dd($request);
        if ($request->personaDni == '10000008') {
            // code...
            //dd($request->personaDni);
            return [];
        } else {

            return [
            'personaDni' =>'required|string|max:8|min:8',
            'personaNombre' =>'required|string',
            'personaApellPat' =>'required|string',
            'personaApellMat' =>'required|string',
           
            'personaDireccion' =>'required|string',
        
           
            
        ];
        }
        

        
    }

    public function messages(){
        return [
            'personaDni.required' => 'dni requerido',
            'personaNombre.required' => 'nombres requerido',
            'personaApellPat.required' => 'apellPat requerido',
            'personaApellMat.required' => 'apellMat requerido',
            'sexo.required' => 'sexo requerido',
            'personaDireccion.required' => 'direccion requerido',
            
            'personaDni.string' => 'El valor no es correcto',
            'personaNombre.string' => 'El valor no es correcto',
            'personaApellPat.string' => 'El valor no es correcto',
            'personaApellMat.string' => 'El valor no es correcto',
            'personaDireccion.string' => 'El valor no es correcto',
            
            'personaDni.max' => 'Se requiere DNI del solicitante',
            'personaDni.min' => 'Se requiere DNI del solicitante',

            

            
            

        ];
    }
}
