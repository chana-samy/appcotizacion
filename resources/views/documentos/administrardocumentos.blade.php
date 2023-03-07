<x-app-layout>
    <div class="card">
        <div class="card-body">
            <form action="{{route('requerimientos.documentosinsertar')}}" method="POST" id="frmInsertDocumento" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Nombre*</label>
                        <input type="text" class="form-control" id="txtNombre" name="txtNombre">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="fileDocumento">Documento*</label>
                        <input type="file" class="form-control" id="fileDocumento" name="fileDocumento"
                                    accept=".pdf">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">&nbsp;</label>
                        <input type="hidden" value="{{$requerimiento->idRequerimiento}}" name="idRequerimiento">
                        <button class="btn btn-primary btn-block" type="button" onclick="sendFrmInsertDocumento()">Agregar Documento</button>
                    </div>
                </div>
            </form> 
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body shadow-lg table-responsive p-0">
                    <table class="table text-nowrap table-striped">
                        <thead>
                            <tr class="bg-lightblue">
                                <th>Nombre</th>
                                <th width="10%">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requerimiento->documentos as $documento)
                            <tr>
                                <td>{{$documento->nombre}}</td>
                                <td align="right">
                                    <a href="{{asset('storage/'.$documento->url)}}" class="btn btn-success btn-sm px-1 py-0" data-toggle="tooltip" data-placement="left" title="Ver documento" target="_blanck">
                                       <i class="fa-solid fa-eye"></i>
                                    </a> 
                                    <button class="btn btn-danger btn-sm px-1 py-0" data-toggle="tooltip" data-placement="left" title="Eliminar documento" onclick="confirmDialogSend('delete{{ $documento->idDocumento }}Documento')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button> 
                                    <form id="delete{{ $documento->idDocumento }}Documento" action="{{ route('requerimientos.eliminardoc',$documento->idDocumento) }}" method="POST" hidden>
                                        <input type="text" name="idRequerimiento" value="{{$requerimiento->idRequerimiento}}" hidden>
                                        @csrf
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script src="{{asset('recursos/documentos/administrardocumentos.js?x='.env('CACHE_LAST_UPDATE'))}}"></script>
    @endpush
</x-app-layout>
