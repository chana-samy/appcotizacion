<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TUsuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table='tusuario';
    protected  $primaryKey='idUsuario';
    public $keyType='string';
    public $incrementing=false; 
    public $timestamps=true;
    protected $fillable = [
        'nombre',
        'correo',
        'contrasenia',
       
    ];

    protected $hidden = [
        'contrasenia',
      
    ];
    

    public function requerimientos(){
        return $this->hasMany(TRequerimiento::class,'idUsuario');
        
    }
    public function excepciones(){
        return $this->hasMany(TExcepcion::class,'idUsuario');
    }
   
}
