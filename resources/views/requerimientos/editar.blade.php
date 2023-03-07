<form action="{{route('requerimientos.editar',$requerimiento->idRequerimiento)}}" id="frmEditarRequerimiento" method="POST" autocomplete="off">
    @csrf
    <div class="form-group">
        <label for="txtDescripcion">Descripcion*</label>
        <textarea id="txtDescripcion" name="txtDescripcion" class="form-control" rows="5" style="resize: none">{{$requerimiento->descripcion}}</textarea>
    </div>
    <div class="form-group d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="button" class="btn bg-lightblue" onclick="sendFrmEditarRequerimiento()">Guardar cambios</button>
    </div>
</form>
<script src="{{asset('recursos/requerimientos/editar.js?x='.env('CACHE_LAST_UPDATE'))}}"></script>