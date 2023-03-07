<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="form-group card">
        <form id="frmEditarPerfil" action="{{ route('usuarios.perfil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                    <label for="txtNombre">Nombre</label>
                        <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="{{ auth()->user()->nombre }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="txtApellido">Apellido</label>
                        <input type="text" class="form-control" id="txtApellido" name="txtApellido" value="{{ auth()->user()->apellido }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="txtCorreo">Correo</label>
                        <input type="text" class="form-control" id="txtCorreo" name="txtCorreo" value="{{ auth()->user()->correo }}" {{ auth()->user()->rol != 'super usuario' ? 'disabled' : '' }}>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="txtDni">DNI</label>
                        <input type="text" class="form-control" id="txtDni" name="txtDni" value="{{ auth()->user()->dni }}" {{ auth()->user()->rol != 'super usuario' ? 'disabled' : '' }}>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileFoto">Foto</label>
                    <input type="file" class="form-control" id="fileFoto" name="fileFoto">
                </div>
                <hr>
                <div class="form-group d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" onclick="sendFrmEditarPerfil()">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
    @push('js')
        <script src="{{ asset('recursos/usuarios/perfil.js?x='.env('CACHE_LAST_UPDATE')) }}"></script>
    @endpush
</x-app-layout>