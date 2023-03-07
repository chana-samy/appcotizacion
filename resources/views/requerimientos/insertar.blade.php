<form action="{{route('requerimientos.insertar')}}" id="frmInsertRequerimiento" method="POST" autocomplete="off">
    @csrf
    <div class="form-group">
        <label for="txtDescripcion"> Descripcion</label>
        <textarea id="txtDescripcion" name="txtDescripcion" class="form-control" rows="5" style="resize: none"></textarea>
    </div>
    <div class="row">
       
        <div class="col-md-6">
            <div class="form-group">
                <label for="txtFechaCierre">Fecha Cierre*</label>
                <input type="datetime-local" id="txtFechaCierre" name="txtFechaCierre" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="button" class="btn bg-lightblue" onclick="sendFrmInsertRequerimiento()">Registrar requerimiento</button>
    </div>
</form>
<script src="{{asset('recursos/requerimientos/insertar.js?x='.env('CACHE_LAST_UPDATE'))}}"></script>