<form id="frmInstarUsuario" action="{{ route('usuarios.insertar') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="txtNombre">Nombre</label>
            <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre">
        </div>
        <div class="col-md-6 form-group">
            <label for="txtApellido">Apellido</label>
            <input type="text" id="txtApellido" name="txtApellido" class="form-control" placeholder="Apellido">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="txtCorreo">Correo*</label>
            <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="Correo">
        </div>
        <div class="col-md-6 form-group">
            <label for="txtDni">DNI*</label>
            <input type="text" id="txtDni" name="txtDni" class="form-control" placeholder="DNI">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="password">Contraseña*</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
        </div>
        <div class="col-md-6 form-group">
            <label for="password_confirmation">Confirmar Contraseña*</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label for="fileFoto">Foto</label>
            <input type="file" id="fileFoto" name="fileFoto" class="form-control" placeholder="Foto" accept=".png,.jpg,.jpeg">
        </div>
    </div>
    <hr>
    <div class="form-group d-flex justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="sendFrmInsertarUsuario()">Guardar datos</button>
    </div>
</form>
<script src="{{ asset('recursos/usuarios/insertar.js?x='.env('CACHE_LAST_UPDATE')) }}"></script>