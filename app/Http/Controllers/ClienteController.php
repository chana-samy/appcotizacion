<?php

namespace App\Http\Controllers;

use App\Models\TCotizacion;
use App\Models\TRequerimiento;
use App\Validators\CotizacionValidator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function listaCotizacion(Request $request){
        $anio=$request->has('anio') ? $request->input('anio'): date('Y') ;
        $estado=$request->has('estado') ? $request->input('estado'): 'vigente' ;
        $fechaActual=date('Y-m-d H:i:s');

        $requerimientos = TRequerimiento::with(['documentos'])->where(function(Builder $query) use($estado,$fechaActual){
            if($estado=='vigente'){
                $query->where('created_at','<=',$fechaActual)->where('fechaCierre','>=',$fechaActual);
            }
            else if($estado=='cerrado'){
                $query->where('created_at','>',$fechaActual)->orWhere('fechaCierre','<',$fechaActual);
            }
        })
        ->whereYear('created_at',$anio)->orderBy('fechaCierre','desc')->paginate(10);

        $requerimientos->appends(['anio'=>$anio,'estado'=>$estado]);

        return view('listacotizacion',[
            'anio'=>$anio,
            'estado'=>$estado,
            'requerimientos'=>$requerimientos,
        ]);      
    }
    public function insertarCotizacion(Request $request, $codigo)
    {
        $currentDate=date('Y-m-d H:i:s');
        if($_POST)
        {
            try
            {
                DB::beginTransaction();
                //return $request;
                $this->_so->mo->listMessage=(new CotizacionValidator())->validationInsert($request);

                if($this->_so->mo->existsMessage())
                {
                    DB::rollBack();
                    Session::flash('globalMessage',$this->_so->mo->listMessage);
                    Session::flash('globalType','error');
                    return back();
                }  

                $requerimiento=TRequerimiento::where('codigo',$codigo)->first();
                if(!$requerimiento->vigente)
                {
                    DB::rollBack();
                    return back();
                }

                $cotizacion=new TCotizacion();
                $cotizacion->idCotizacion=uniqid();
                $cotizacion->idRequerimiento=$requerimiento->idRequerimiento;
                $cotizacion->tipoPersona=trim($request->input('selectTipoPersona'));
                $cotizacion->nombre='';
                $cotizacion->dni='';
                $cotizacion->razonSocial='';
                $cotizacion->ruc='';
                if($request->selectTipoPersona=='natural'){
                    $cotizacion->nombre=trim($request->input('txtNombre'));
                    $cotizacion->dni=trim($request->input('txtDocumento'));
                }
                else{
                    $cotizacion->razonSocial=trim($request->input('txtNombre'));
                    $cotizacion->ruc=trim($request->input('txtDocumento'));
                }
                $cotizacion->telefono=trim($request->input('txtTelefono'));
                $cotizacion->correo=trim($request->input('txtCorreo'));
                $cotizacion->asunto=trim($request->input('txtAsunto'));
                $cotizacion->observacion=trim($request->input('txtObservacion'));
                $cotizacion->urlDocumento='';
                $cotizacion->estado='pediente';

                if($request->hasFile('fileCotizacion')){
                    $url=Storage::disk('private')->put('cotizaciones',$request->file('fileCotizacion'));
                    $cotizacion->urlDocumento=$url;
                }
                $cotizacion->save();

                DB::commit();

                Session::flash('message', 'Se ha enviado su cotización correctamente');
                Session::flash('type','success');

                return back();
            }
            catch(\Exception $e){
                DB::rollBack();
                Session::flash('message', 'Ocurrió un error al enviar su cotización');
                Session::flash('type','error');
                return back();
            }
        }
        $requerimiento=TRequerimiento::where('codigo',$codigo)->first();

        if(!$requerimiento->vigente)
        {
            Session::flash('message', 'Ya no se aceptan mas postulantes para esta cotización');
            Session::flash('type','warning');
        }

        return view('formulariocotizacion',compact('requerimiento'));
    }

    public function listaDocumentos($codigo){
        try
        {
            $requerimiento=TRequerimiento::where('codigo',$codigo)->first();

            if($requerimiento==null){
                return response()->json([
                    'message'=>'No se encontró el requerimiento',
                    'type'=>'error'
                ],404);
            }

            $documentos=$requerimiento->documentos;
            return view('listadocumentos',compact('documentos'));
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>'Ocurrió un error al obtener los documentos',
                'type'=>'error'
            ],500);
        }
    }
}
