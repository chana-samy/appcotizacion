<form action="{{route('documentos.insertar')}}" id="frmInsertDocumento" method="POST" autocomplete="off">
    @csrf
    <div class="form-group">
        <label for="txtDocumento"> Nombre del Documento</label>
        <textarea id="txtDocumento" name="txtDocumento" class="form-control" rows="5" style="resize: none"></textarea>
    </div>
    <div class="form-group">
        <label for="txtUrl">URL de Documento*</label>
        <input type="text" id="txtUrl" name="txtUrl" class="form-control">
    </div>
    <div class="form-group d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="button" class="btn bg-lightblue" onclick="sendFrmInsertDocumento()">Registrar datos</button>
    </div>
</form>
<script src="{{asset('recursos/documentos/insertar.js?x='.env('CACHE_LAST_UPDATE'))}}"></script>