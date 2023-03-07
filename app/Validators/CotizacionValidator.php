<?php
namespace App\Validators;

use Illuminate\Support\Facades\Validator;
class CotizacionValidator{
    private $globalMessage=[];
    
   public function validationInsert($request){
        $validator=Validator::make(
        [
            'tipoPersona'=>trim($request->input('selectTipoPersona')),
            'nombre'=>trim($request->input('txtNombre')),
            'documento'=>trim($request->input('txtDocumento')),
            'correo'=>trim($request->input('txtCorreo')),
            'telefono'=>trim($request->input('txtTelefono')),
            'asunto'=>trim($request->input('txtAsunto')),
            'descripcion'=>trim($request->input('txtObservacion')),
            'fileArchivo'=>$request->file('fileCotizacion'),
        ],
        [
            'tipoPersona'=>['required','in:natural,juridico'],
            'nombre'=>['required','max:100'],
            'documento'=>[
                'required_if:tipoPersona,natural|max:8|min:8|regex:/^[0-9]+$/',
                'required_if:tipoPersona,juridico|max:11|min:11|regex:/^[0-9]+$/',
            ],
            'correo'=>['required','max:100','email'],
            'telefono'=>['required','max:9','min:9','regex:/^[0-9]+$/'],
            'asunto'=>['required','max:100'],
            //'descripcion'=>['required','max:700'],
            'fileArchivo'=>['required','mimes:pdf,doc,docx,xls,xlsx'],
        ],
        [
            'required'=>'El campo :attribute es obligatorio',
            'required_if'=>'El campo :attribute es obligatorio',
            'max'=>'El campo :attribute debe tener como máximo :max caracteres',
            'min'=>'El campo :attribute debe tener como mínimo :min caracteres',
            'email'=>'El campo :attribute debe ser un correo electrónico válido',
            'regex'=>'El campo :attribute debe ser un número válido',
            'mimes'=>'El campo :attribute debe ser un archivo con formato :values',
            'in'=>'El campo :attribute debe ser :values',
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
}
