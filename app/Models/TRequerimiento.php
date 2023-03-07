<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TRequerimiento extends Model
{
    use HasFactory;
    protected $table='trequerimiento';
    protected  $primaryKey='idRequerimiento';
    public $keyType='string';
    public $incrementing=false; 
    public $timestamps=true;

    public function usuario(){
        return $this->belongsTo(TUsuario::class,'idUsuario');
    }

    public function documentos(){
        return $this->hasMany(TDocumento::class,'idRequerimiento');
    }
     
    public function cotizaciones(){
        return $this->hasMany(TCotizacion::class,'idRequerimiento');
    }
    public function vigente():Attribute{
        return Attribute::make(
            get:function(){
                $fechaActual=date('Y-m-d H:i:s');
                if($this->created_at <=$fechaActual && $this->fechaCierre>=$fechaActual)
                {
                    return 1;
                }
                return 0;
            }
        );   
    }
}
