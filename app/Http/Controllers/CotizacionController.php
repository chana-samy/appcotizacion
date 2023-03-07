<?php

namespace App\Http\Controllers;

use App\Helpers\PlatformHelper;
use App\Models\TCotizacion;
use App\Models\TRequerimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Validators\CotizacionValidator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CotizacionController extends Controller
{
    public function index(Request $request,$idRequerimiento)
    {
        $searchParameter=$request->has('search') ? $request->input('search'): '';
        $page=$request->has('page') ? $request->input('page'):1;

        $requerimiento=TRequerimiento::find($idRequerimiento);

        $paginate =PlatformHelper::preparePaginate(TCotizacion::where('idRequerimiento',$idRequerimiento)->where('nombre','LIKE','%'.$searchParameter.'%'),10,$page);

        return view('cotizaciones.index',[
            'data' => $paginate['data'],
            'currentPage' => $paginate['currentPage'],
            'quantityPage' => $paginate['quantityPage'],
            'searchParameter' => $searchParameter,
            'requerimiento' => $requerimiento
        ]);
    }

    public function descargar($idRequerimiento,$idCotizacion)
    {
        //return 'hola';
        $requerimiento=TRequerimiento::find($idRequerimiento);

        if($requerimiento==null)
        {
            Session::flash('globalMessage', ['No se encontró el requerimiento']);
		    Session::flash('type', 'error');
            return back();
        }

        $cotizacion=TCotizacion::find($idCotizacion);

        if($cotizacion==null)
        {
            Session::flash('globalMessage', ['No se encontró la cotización']);
            Session::flash('type', 'error');
            return back();
        }

        if($requerimiento->vigente)
        {
            Session::flash('globalMessage', ['El periodo de cotización aún no ha finalizado']);
            Session::flash('type', 'error');
            return back();
        }

        $cotizacion->estado='leido';
        $cotizacion->save();

        $nombreArchivo=$requerimiento->codigo.'-'.($cotizacion->tipoPersona=='natural' ? $cotizacion->nombre : $cotizacion->razonSocial).'.pdf';

        $file=Storage::disk('private')->get($cotizacion->urlDocumento);
        
        return response($file,200)->header('Content-Type','application/pdf')
        ->header('Content-Disposition','attachment; filename="'.$nombreArchivo.'"');
    }
  
}
