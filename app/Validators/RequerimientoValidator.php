<?php
namespace App\Validators;

use Illuminate\Support\Facades\Validator;
class RequerimientoValidator{
    private $globalMessage=[];
    public function validationInsert($request){
        $validator=Validator::make(
       [
           'descripcion' => trim($request->input('txtDescripcion')),
           'fechaCierre' => trim($request->input('txtFechaCierre')),
       ],
       [
           'descripcion' => ['required'],
           'fechaCierre' => ['required','date_format:Y-m-d H:i:s'],
       ],
       [
           'descripcion.required' => 'El campo "descripcion" es requerido.',
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
   }
   public function validationEdit($request){
       $validator=Validator::make(
      [
          'descripcion' => trim($request->input('txtDescripcion')),
      ],
      [
          'descripcion' => ['required'],
      ],
      [
          'descripcion.required' => 'El campo "descripcion" es requerido.',
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
