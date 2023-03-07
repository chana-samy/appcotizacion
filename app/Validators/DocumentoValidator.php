<?php
namespace App\Validators;

use Illuminate\Support\Facades\Validator;
class DocumentoValidator{
    private $globalMessage=[];
    public function validationInsert($request){
         $validator=Validator::make(
        [
            'nombre' => trim($request->input('txtNombre')),
            'documento' => $request->file('fileDocumento') 
        ],
        [
            'nombre' => ['required'],
            'documento' => ['required','mimes:pdf','max:25600'],
        ],
        [
            'nombre.required' => 'El campo "nombre" es requerido.',
            'documento.required' => 'El campo "documento" es requerido.',
            'documento.mimes' => 'El campo "documento" solo acepta  archivos pdf.',
            'documento.max' => 'El campo "documento" supera el tamaño permitido.'
            
        ]);
    
        if($validator->fails())
        {
            $errors=$validator->errors()->all();

            foreach($errors as $value)
            {
                $this->globalMessage[]=$value;
            }
        }
        return $this->globalMessage;
    }
    /* public function validationEdit($request){
        $validator=Validator::make(
       [
           'descripcion' => trim($request->input('txtDescripcion')),
           'fechaApertura' => trim($request->input('txtFechaApertura')),
           'fechaCierre' => trim($request->input('txtFechaCierre')),
           
       ],
       [
           'descripcion' => ['required'],
           'fechaApertura' => ['required','date_format:Y-m-d H:i:s'],
           'fechaCierre' => ['required','date_format:Y-m-d H:i:s'],
       ],
       [
           'descripcion.required' => 'El campo "descripcion" es requerido.',
           'fechaApertura.required' => 'El campo "fechaApertura" es requerido.',
           'fechaApertura.date_format' => 'El formato de "fechaApertura" es incorrecto.',
           'fechaCierre.required' => 'El campo "fechaCierre" es requerido.',
           'fechaCierre.date_format' => 'El formato de "fechaCierre" es incorrecto.',
       ]);
   
       if($validator->fails())
       {
           $errors=$validator->errors()->all();

           foreach($errors as $value)
           {
               $this->globalMessage[]=$value;
           }
       }
       return $this->globalMessage;
   } */

    
}



?>