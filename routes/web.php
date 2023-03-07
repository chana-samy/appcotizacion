<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\ExcepcionController;
use App\Http\Controllers\RequerimientoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    /* inicio de sesion */
    Route::match(['get','post'],'login',[UsuarioController::class,'login'])->name('login');
});
/* acceso publico */
Route::get('/',[ClienteController::class,'listaCotizacion'])->name('cotizaciones.lista');
Route::match(['get','post'],'cotizaciones/{codigo}/insert',[ClienteController::class,'insertarCotizacion'])->name('cliente.cotizaciones.insertar');
Route::get('cotizaciones/{codigo}/documentos',[ClienteController::class,'listaDocumentos'])->name('cliente.cotizaciones.listadocumentos');

Route::middleware(['auth'])->group(function(){
    /* cerrar sesion */
    Route::post('logout',[UsuarioController::class,'logout'])->name('user.logout');
    Route::group(['middleware' => ['role:administrador,super usuario']], function () {
       /* acceso administrador */
        Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
       // Route::get('/admin',[AdminController::class,'index'])->name('admin.index.requerimientos');
        /* requerimientos */
        Route::get('requerimientos',[RequerimientoController::class,'index'])->name('requerimientos.index');
        Route::match(['get', 'post'], 'requerimientos/insertar', [RequerimientoController::class,'insertar'])->name('requerimientos.insertar');
        Route::match(['get', 'post'], 'requerimientos/editar/{idRequerimiento}', [RequerimientoController::class,'editar'])->name('requerimientos.editar');
        Route::post('requerimientos/eliminardoc/{idDocumento}',[DocumentoController::class,'eliminardoc'])->name('requerimientos.eliminardoc');

        /* documentos */
        Route::post('requerimientos/eliminar/{idRequerimiento}',[RequerimientoController::class,'eliminar'])->name('requerimientos.eliminar');
        Route::get('requerimientos/administrardocumentos/{idRequerimiento}',[DocumentoController::class,'administrarDocumentos'])->name('requerimientos.administrarDocumentos');
        Route::post('requerimientos/documentosinsertar',[DocumentoController::class,'insertarDocumento'])->name('requerimientos.documentosinsertar');
        
        /* cotizaciones */
        Route::get('cotizaciones/{idRequerimiento}',[CotizacionController::class,'index'])->name('cotizaciones.index');
        Route::post('cotizaciones/{idRequerimiento}/{idCotizacion}/descargar',[CotizacionController::class,'descargar'])->name('cotizaciones.descargar'); 
    });

    Route::group(['middleware' => ['role:super usuario']], function () {
        /* usuarios */
        Route::get('usuarios',[UsuarioController::class,'index'])->name('usuarios.index');
        Route::match(['get','post'],'usuarios/insertar',[UsuarioController::class,'insertar'])->name('usuarios.insertar');
        Route::match(['get','post'],'usuarios/editar/{idUsuario}',[UsuarioController::class,'editar'])->name('usuarios.editar');
        Route::post('usuarios/cambiar-estado/{idUsuario}',[UsuarioController::class,'cambiarEstado'])->name('usuarios.cambiarestado');
    });

    Route::match(['get','post'],'perfil',[UsuarioController::class,'perfil'])->name('usuarios.perfil');
});
