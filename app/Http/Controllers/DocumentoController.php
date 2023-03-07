<?php

namespace App\Http\Controllers;

use App\Helpers\PlatformHelper;
use App\Models\TDocumento;
use App\Models\TRequerimiento;
use App\Validators\DocumentoValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index(Request $request)
    {
        $searchParameter = $request->has('search') ? $request->input('search') : '';
        $page = $request->has('page') ? $request->input('page') : 1;
        $paginate = PlatformHelper::preparePaginate(TDocumento::where('nombre', 'LIKE', '%' . $searchParameter . '%'), 5, $page);

        return view('documentos.index', [
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
                $this->_so->mo->listMessage = (new DocumentoValidator())->validationInsert($request);
                if ($this->_so->mo->existsMessage()) {
                    DB::rollBack();
                    return PlatformHelper::redirectError($this->_so->mo->listMessage, route('documentos.index'));
                }
                $documento = new TDocumento();
                $documento->idDocumento = uniqid();
                $documento->idRequerimiento = Auth::user()->idRequerimiento;
                $documento->nombre = trim($request->input('txtDocumento'));

                $documento->save();
                DB::commit();
                return PlatformHelper::redirectCorrect(['Operancion realizada correctamente.'], route('documentos.index'));
            } catch (\Exception $e) {
                DB::rollBack();
                return PlatformHelper::redirectError(['Excepción ocurrida en el sistema, por favor contacte al administrador del sistema.'], route('documentos.index'));
            }
        }
        return view('documentos.insertar');
    }
    public function administrarDocumentos(Request $request, $idRequerimiento)
    {
        $requerimiento = TRequerimiento::with(['documentos'])->find($idRequerimiento);
        if ($requerimiento == null) {
            return PlatformHelper::redirectError(['El requerimiento no existe.'], route('requerimientos.index'));
        }
        return view('documentos.administrardocumentos', compact('requerimiento'));
    }
    public function insertarDocumento(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->_so->mo->listMessage = (new DocumentoValidator())->validationInsert($request);
            if ($this->_so->mo->existsMessage()) {
                DB::rollBack();
                return PlatformHelper::redirectError($this->_so->mo->listMessage, route('requerimientos.administrarDocumentos', $request->idRequerimiento));
            }
            $documento = new TDocumento();
            $documento->idDocumento = uniqid();
            $documento->idRequerimiento = $request->idRequerimiento;
            $documento->nombre = trim($request->input('txtNombre'));
            $direccion = Storage::disk('public')->put('requerimientos', $request->file('fileDocumento'));
            $documento->url = $direccion;
            $documento->save();
            DB::commit();
            return PlatformHelper::redirectCorrect(['Operancion realizada correctamente.'], route('requerimientos.administrarDocumentos', $request->idRequerimiento));
        } catch (\Exception $e) {
            DB::rollBack();
            return PlatformHelper::redirectError(['Excepción ocurrida en el sistema, por favor contacte al administrador del sistema.'], route('requerimientos.administrarDocumentos', $request->idRequerimiento));
        }
    }
    public function eliminardoc(Request $request, $idDocumento)
    {
        try {
            DB::beginTransaction();
            $documento = TDocumento::find($idDocumento);
            if ($documento == null) {
                DB::rollBack();
                return PlatformHelper::redirectError(['El documento no existe.'], route('requerimientos.administrarDocumentos', $request->idRequerimiento));
            }
            $documento->delete();
            Storage::disk('public')->delete($documento->url);
            DB::commit();

            return PlatformHelper::redirectCorrect(['Operancion realizada correctamente.'], route('requerimientos.administrarDocumentos', $request->idRequerimiento));
        } catch (\Exception $e) {
            DB::rollBack();
            return PlatformHelper::redirectError(['Excepción ocurrida en el sistema, por favor contacte al administrador del sistema.'], route('requerimientos.administrarDocumentos', $request->idRequerimiento));
        }
    }
}
