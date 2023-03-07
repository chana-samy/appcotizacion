<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCotizacion extends Model
{
    use HasFactory;
    protected $table='tcotizacion';
    protected  $primaryKey='idCotizacion';
    public $keyType='string';
    public $incrementing=false; 
    public $timestamps=true;

    public function requerimiento(){
        return $this->belongsTo(TRequerimiento::class,'idRequerimiento');
    }
}
