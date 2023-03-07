<?php

namespace App\Http\Controllers;

use App\Models\TCotizacion;
use App\Models\TRequerimiento;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $requerimientos=TRequerimiento::count();
        $cotizaciones=TCotizacion::count();

        return view('admin.index',[
            'req'=>$requerimientos,
            'cot'=>$cotizaciones
        ]);
    }
}
