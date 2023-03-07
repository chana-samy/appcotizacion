<?php
namespace App\Validators;

use Illuminate\Support\Facades\Validator;
class UsuarioValidator{
    private $globalMessage=[];
    public function validationLogin($request){
         $validator=Validator::make(
        [
            'email' => trim($request->input('email')),
            'password' => trim($request->input('password')),
            
        ],
        [
            'email' => ['required','email'],
            'password' => ['required'],
        ],
        [
            'email.required' => 'El campo "email" es requerido.',
            'password.required' => 'El campo "Password" es requerido.',
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
    
    public function validationInsert($request){
        $validator=Validator::make(
        [
            'nombre' => trim($request->input('txtNombre')),
            'apellido' => trim($request->input('txtApellido')),
            'email' => trim($request->input('txtCorreo')),
            'password' => trim($request->input('password')),
            'password_confirmation' => trim($request->input('password_confirmation')),
            'dni' => trim($request->input('txtDni')),
            'avatar' => $request->file('fileFoto'),
        ],
        [
            'nombre' => ['required'],
            'apellido' => ['required'],
            'email' => ['required','email','unique:tusuario,correo'],
            'password' => ['required','min:8','confirmed'],
            'dni' => ['required','min:8','max:8','unique:tusuario'],
            'avatar' => ['nullable','image','mimes:jpeg,png,jpg','max:2048'],
        ],
        [
            'nombre.required' => 'El campo "Nombre" es requerido.',
            'apellido.required' => 'El campo "Apellido" es requerido.',
            'email.required' => 'El campo "Email" es requerido.',
            'email.email' => 'El campo "Email" debe ser un email válido.',
            'email.unique' => 'El campo "Email" ya se encuentra registrado.',
            'password.required' => 'El campo "Password" es requerido.',
            'password.min' => 'El campo "Password" debe tener al menos 8 caracteres.',
            'password.confirmed' => 'El campo "Password" no coincide con la confirmación.',
            'dni.required' => 'El campo "DNI" es requerido.',
            'dni.min' => 'El campo "DNI" debe tener 8 caracteres.',
            'dni.max' => 'El campo "DNI" debe tener 8 caracteres.',
            'dni.unique' => 'El campo "DNI" ya se encuentra registrado.',
            'avatar.image' => 'El archivo debe ser una imagen.',
            'avatar.mimes' => 'El archivo debe ser una imagen con formato jpeg, png o jpg.',
            'avatar.max' => 'El archivo debe pesar menos de 2MB.',
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

    public function validationEdit($request,$idUsuario){
        $validator=Validator::make(
        [
            'nombre' => trim($request->input('txtNombre')),
            'apellido' => trim($request->input('txtApellido')),
            'email' => trim($request->input('txtCorreo')),
            'dni' => trim($request->input('txtDni')),
            'password' => trim($request->input('password')),
            'password_confirmation' => trim($request->input('password_confirmation')),
            'avatar' => $request->file('fileFoto'),
        ],
        [
            'nombre' => ['required'],
            'apellido' => ['required'],
            'email' => ['required','email','unique:tusuario,correo,'.$idUsuario.',idUsuario'],
            'dni' => ['required','min:8','max:8','unique:tusuario,dni,'.$idUsuario.',idUsuario'],
            'password' => ['nullable','min:8','confirmed'],
            'avatar' => ['nullable','image','mimes:jpeg,png,jpg','max:2048'],
        ],
        [
            'nombre.required' => 'El campo "Nombre" es requerido.',
            'apellido.required' => 'El campo "Apellido" es requerido.',
            'email.required' => 'El campo "Email" es requerido.',
            'email.email' => 'El campo "Email" debe ser un email válido.',
            'email.unique' => 'El campo "Email" ya se encuentra registrado.',
            'dni.required' => 'El campo "DNI" es requerido.',
            'dni.min' => 'El campo "DNI" debe tener 8 caracteres.',
            'dni.max' => 'El campo "DNI" debe tener 8 caracteres.',
            'dni.unique' => 'El campo "DNI" ya se encuentra registrado.',
            'password.min' => 'El campo "Password" debe tener al menos 8 caracteres.',
            'password.confirmed' => 'El campo "Password" no coincide con la confirmación.',
            'avatar.image' => 'El archivo debe ser una imagen.',
            'avatar.mimes' => 'El archivo debe ser una imagen con formato jpeg, png o jpg.',
            'avatar.max' => 'El archivo debe pesar menos de 2MB.',
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

    public function validationEditPerfil($request){
        $rol=auth()->user()->rol;
        $idUsuario=auth()->user()->idUsuario;
        $validator=Validator::make(
        [
            'nombre' => trim($request->input('txtNombre')),
            'apellido' => trim($request->input('txtApellido')),
            'email' => trim($request->input('txtCorreo')),
            'dni' => trim($request->input('txtDni')),
            'password' => trim($request->input('password')),
            'password_confirmation' => trim($request->input('password_confirmation')),
            'avatar' => $request->file('fileFoto'),
            'rol' => $rol,
        ],
        [
            'nombre' => ['required'],
            'apellido' => ['required'],
            'email' => ['required_if:rol,super usuario','email','unique:tusuario,correo,'.$idUsuario.',idUsuario'],
            'dni' => ['required_if:rol,super usuario','min:8','max:8','unique:tusuario,dni,'.$idUsuario.',idUsuario'],
            'password' => ['nullable','min:8','confirmed'],
            'avatar' => ['nullable','image','mimes:jpeg,png,jpg','max:2048'],
        ],
        [
            'nombre.required' => 'El campo "Nombre" es requerido.',
            'apellido.required' => 'El campo "Apellido" es requerido.',
            'email.required_if' => 'El campo "Email" es requerido.',
            'email.email' => 'El campo "Email" debe ser un email válido.',
            'email.unique' => 'El campo "Email" ya se encuentra registrado.',
            'dni.required_if' => 'El campo "DNI" es requerido.',
            'dni.min' => 'El campo "DNI" debe tener 8 caracteres.',
            'dni.max' => 'El campo "DNI" debe tener 8 caracteres.',
            'dni.unique' => 'El campo "DNI" ya se encuentra registrado.',
            'password.min' => 'El campo "Password" debe tener al menos 8 caracteres.',
            'password.confirmed' => 'El campo "Password" no coincide con la confirmación.',
            'avatar.image' => 'El archivo debe ser una imagen.',
            'avatar.mimes' => 'El archivo debe ser una imagen con formato jpeg, png o jpg.',
            'avatar.max' => 'El archivo debe pesar menos de 2MB.',
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
?>