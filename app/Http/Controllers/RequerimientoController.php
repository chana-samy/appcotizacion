<?php

namespace App\Http\Controllers;

use App\Helpers\PlatformHelper;
use App\Models\TRequerimiento;
use App\Validators\RequerimientoValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequerimientoController extends Controller
{
    public function index(Request $request)
    {
        $searchParameter = $request->has('search') ? $request->input('search') : '';
        $page = $request->has('page') ? $request->input('page') : 1;
        $paginate = PlatformHelper::preparePaginate(TRequerimiento::where('descripcion', 'LIKE', '%' . $searchParameter . '%'), 10, $page);

        return view('requerimientos.index', [
            'data' => $paginate['data'],
            'currentPage' => $paginate['currentPage'],
            'quantityPage' => $paginate['quantityPage'],
            'searchParameter' => $searchParameter
        ]);
    }
    public function insertar(Request $request)
    {
        if ($_POST) {
            try {
                DB::beginTransaction();
                $request->merge([
                    'txtFechaCierre' => date_format(date_create($request->input('txtFechaCierre')), 'Y-m-d H:i:s'),
                ]);
                $this->_so->mo->listMessage = (new RequerimientoValidator())->validationInsert($request);
                if ($this->_so->mo->existsMessage()) {
                    DB::rollBack();
                    return PlatformHelper::redirectError($this->_so->mo->listMessage, route('requerimientos.index'));
                }
                $requerimiento = new TRequerimiento();
                $requerimiento->idRequerimiento = uniqid();
                $requerimiento->idUsuario = Auth::user()->idUsuario;
                $requerimiento->descripcion = trim($request->input('txtDescripcion'));
                $requerimiento->estado = 'Cerrado';
                $requerimiento->fechaCierre = $request->input('txtFechaCierre');
                $ultimoCodigo = TRequerimiento::max('codigo');
                $codigo = 1;
                if ($ultimoCodigo && explode('-', $ultimoCodigo)[0] == date('Y')) {
                    $codigo = intval(explode('-', $ultimoCodigo)[1]) + 1;
                }
                $requerimiento->codigo = date('Y') . '-' . str_pad($codigo, 8, '0', STR_PAD_LEFT);

                $requerimiento->save();
                DB::commit();
                return PlatformHelper::redirectCorrect(['Operancion realizada correctamente.'], route('requerimientos.index'));
            } catch (\Exception $e) {
                DB::rollBack();
                PlatformHelper::redirectError(['Excepción ocurrida en el sistema, por favor contacte al administrador del sistema.'], route('requerimientos.index'));
            }
        }
        return view('requerimientos.insertar');
    }
    public function editar(Request $request, $idRequerimiento)
    {
        if ($_POST) {
            try {
                DB::beginTransaction();
                
                $this->_so->mo->listMessage = (new RequerimientoValidator())->validationEdit($request);
                if ($this->_so->mo->existsMessage()) {
                    DB::rollBack();
                    return PlatformHelper::redirectError($this->_so->mo->listMessage, route('requerimientos.index'));
                }
                $requerimiento = TRequerimiento::find($idRequerimiento);
                if ($requerimiento == null) {
                    DB::rollBack();
                    return PlatformHelper::redirectError(['No existe el requerimiento.'], route('requerimientos.index'));
                }
                $requerimiento->descripcion = trim($request->input('txtDescripcion'));
                $requerimiento->save();
                DB::commit();
                return PlatformHelper::redirectCorrect(['Operancion realizada correctamente.'], route('requerimientos.index'));
            } catch (\Exception $e) {
                DB::rollBack();
                PlatformHelper::redirectError(['Excepción ocurrida en el sistema, por favor contacte al administrador del sistema.'], route('requerimientos.index'));
            }
        }
        $requerimiento = TRequerimiento::find($idRequerimiento);
        if ($requerimiento == null) {
            DB::rollBack();
            return PlatformHelper::redirectError(['No existe el requerimiento.'], route('requerimientos.index'));
        }
        return view('requerimientos.editar', [
            'requerimiento' => $requerimiento
        ]);
    }
    public function eliminar($idRequerimiento)
    {
        try {
            DB::beginTransaction();
            $requerimiento = TRequerimiento::find($idRequerimiento);
            if ($requerimiento == null) {
                DB::rollBack();
                return PlatformHelper::redirectError(['No existe el requerimiento.'], route('requerimientos.index'));
            }

            if (!$requerimiento->vigente || count($requerimiento->cotizaciones) > 0) {
                DB::rollBack();
                return PlatformHelper::redirectError(['No se puede eliminar el requerimiento porque tiene cotizaciones asociadas.'], route('requerimientos.index'));
            }

            $requerimiento->delete();
            DB::commit();

            return PlatformHelper::redirectCorrect(['Operancion realizada correctamente.'], route('requerimientos.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            PlatformHelper::redirectError(['Excepción ocurrida en el sistema, por favor contacte al administrador del sistema.'], route('requerimientos.index'));
        }
    }
}
