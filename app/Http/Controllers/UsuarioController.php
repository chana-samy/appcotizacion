<?php

namespace App\Http\Controllers;

use App\Helpers\PlatformHelper;
use App\Models\TUsuario;
use App\Providers\RouteServiceProvider;
use App\Validators\UsuarioValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    //
    public function login(Request $request){
        if($_POST){
            $usuario = TUsuario::where('correo',$request->email)->first();
            if($usuario && Hash::check($request->password,$usuario->contrasenia)){

                if($usuario->estado != 'habilitado' && $usuario->rol != 'super usuario'){
                   return PlatformHelper::redirectError(['El usuario se encuentra suspendido'], route('login'));
                }

                Auth::login($usuario);
                $request->session()->regenerate();

                return redirect()->intended(RouteServiceProvider::HOME);

            }
            return PlatformHelper::redirectError(['Correo o contraseña incorrectos'], route('login'));
        }
        return view('auth.login');
    }
    public function logout(Request $request){
        
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function index(Request $request){
        $searchParameter=$request->has('search') ? $request->input('search'): '';
        $page=$request->has('page') ? $request->input('page'):1;

        $usuarios=TUsuario::where(function($query) use ($searchParameter){
            $query->where('nombre','LIKE','%'.$searchParameter.'%')
                ->orWhere('apellido','LIKE','%'.$searchParameter.'%')
                ->orWhere('correo','LIKE','%'.$searchParameter.'%')
                ->orWhere('dni','LIKE','%'.$searchParameter.'%');
        })->where('rol','!=','super usuario');

        $paginate =PlatformHelper::preparePaginate($usuarios,10,$page);

        return view('usuarios.index',[
            'data' => $paginate['data'],
            'currentPage' => $paginate['currentPage'],
            'quantityPage' => $paginate['quantityPage'],
            'searchParameter' => $searchParameter
        ]);
    }

    public function insertar(Request $request){
        if($_POST)
        {
            try{
                DB::beginTransaction();
                $this->_so->mo->listMessage = (new UsuarioValidator())->validationInsert($request);

                if($this->_so->mo->existsMessage())
                {
                    DB::rollBack();
                    return PlatformHelper::redirectError($this->_so->mo->listMessage,route('usuarios.index'));
                }

                $usuario = new TUsuario();
                $usuario->idUsuario = uniqid();
                $usuario->nombre = trim($request->input('txtNombre'));
                $usuario->apellido = trim($request->input('txtApellido'));
                $usuario->correo = trim($request->input('txtCorreo'));
                $usuario->contrasenia = bcrypt($request->input('password'));
                $usuario->rol = 'administrador';
                $usuario->dni = trim($request->input('txtDni'));
                $usuario->estado = 'habilitado';
                $usuario->foto='';

                if($request->hasFile('fileFoto')){
                    $url = Storage::disk('public')->put('fotos',$request->file('fileFoto'));
                    $usuario->foto = $url;
                }

                $usuario->save();

                DB::commit();

                return PlatformHelper::redirectCorrect(['Operación realizada correctamente.'],route('usuarios.index'));
            }catch(\Exception $e){
                DB::rollBack();
                return PlatformHelper::redirectError(['Ocurrió un error inesperado.'],route('usuarios.index'));
            }
        }
        return view('usuarios.insertar');
    }

    public function editar(Request $request, $idUsuario){
        $usuario = TUsuario::find($idUsuario);
        if(!$usuario){
            return PlatformHelper::redirectError(['El usuario no existe.'],route('usuarios.index'));
        }
        
        if($usuario->rol == 'super usuario'){
            DB::rollBack();
            return PlatformHelper::redirectError(['No se puede cambiar el estado del super usuario.'],route('usuarios.index'));
        }

        if($_POST)
        {
            try{
                DB::beginTransaction();
                
                $this->_so->mo->listMessage = (new UsuarioValidator())->validationEdit($request,$idUsuario);

                if($this->_so->mo->existsMessage())
                {
                    DB::rollBack();
                    return PlatformHelper::redirectError($this->_so->mo->listMessage,route('usuarios.index'));
                }

                $usuario->nombre = trim($request->input('txtNombre'));
                $usuario->apellido = trim($request->input('txtApellido'));
                $usuario->correo = trim($request->input('txtCorreo'));
                $usuario->dni = trim($request->input('txtDni'));
                $usuario->contrasenia = $request->input('password') ? bcrypt($request->input('password')) : $usuario->contrasenia;
                
                if($request->hasFile('fileFoto')){
                    if($usuario->foto){
                        Storage::disk('public')->delete($usuario->foto);
                    }

                    $url = Storage::disk('public')->put('fotos',$request->file('fileFoto'));
                    $usuario->foto = $url;
                }

                $usuario->save();

                DB::commit();

                return PlatformHelper::redirectCorrect(['Operación realizada correctamente.'],route('usuarios.index'));
            }catch(\Exception $e){
                DB::rollBack();
                return PlatformHelper::redirectError(['Excepción ocurrida en el sistema, por favor contacte al administrador del sistema.'],route('usuarios.index'));
            }
        }
        return view('usuarios.editar',compact('usuario'));
    }

    public function cambiarEstado($idUsuario){
        $usuario = TUsuario::find($idUsuario);
        if(!$usuario){
            return PlatformHelper::redirectError(['El usuario no existe.'],route('usuarios.index'));
        }
        try{
            DB::beginTransaction();

            if($usuario->rol == 'super usuario'){
                DB::rollBack();
                return PlatformHelper::redirectError(['No se puede cambiar el estado del super usuario.'],route('usuarios.index'));
            }

            $usuario->estado = $usuario->estado == 'habilitado' ? 'suspendido' : 'habilitado';
            $usuario->save();
            DB::commit();
            return PlatformHelper::redirectCorrect(['Operación realizada correctamente.'],route('usuarios.index'));
        }catch(\Exception $e){
            DB::rollBack();
            return PlatformHelper::redirectError(['Excepción ocurrida en el sistema, por favor contacte al administrador del sistema.'],route('usuarios.index'));
        }
    }

    public function perfil(Request $request){
        if($_POST)
        {
            try{
                DB::beginTransaction();
                $this->_so->mo->listMessage = (new UsuarioValidator())->validationEditPerfil($request);

                if($this->_so->mo->existsMessage())
                {
                    DB::rollBack();
                    return PlatformHelper::redirectError($this->_so->mo->listMessage,route('usuarios.perfil'));
                }

                $usuario = TUsuario::find(Auth::user()->idUsuario);
                $usuario->nombre = trim($request->input('txtNombre'));
                $usuario->apellido = trim($request->input('txtApellido'));
                if($usuario->rol=='super usuario'){
                    $usuario->correo = trim($request->input('txtCorreo'));
                    $usuario->dni = trim($request->input('txtDni'));
                }
                $usuario->contrasenia = $request->input('password') ? bcrypt($request->input('password')) : $usuario->contrasenia;
                
                if($request->hasFile('fileFoto')){
                    if($usuario->foto){
                        Storage::disk('public')->delete($usuario->foto);
                    }

                    $url = Storage::disk('public')->put('fotos',$request->file('fileFoto'));
                    $usuario->foto = $url;
                }

                $usuario->save();

                DB::commit();

                return PlatformHelper::redirectCorrect(['Operación realizada correctamente.'],route('usuarios.perfil'));
            }catch(\Exception $e){
                DB::rollBack();
                return PlatformHelper::redirectError(['Excepción ocurrida en el sistema, por favor contacte al administrador del sistema.'],route('usuarios.perfil'));
            }
        }
        return view('auth.perfil');
    }
}
