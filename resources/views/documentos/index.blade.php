<x-app-layout>
    <div class="row">
        <div class="col-md-1">
            <button class="btn bg-olive btn-sm elevation-3" data-toggle="tooltip" data-placement="right"
                title="Agregar Documento"
                onclick="ajaxDialog('divGeneralContainer', 'modal-lg', 'Insertar Nuevo Documento', null, '{{route('documentos.insertar')}}', 'GET', null, null, false, true);">
                <i class="fas fa-plus fa-lg"></i>
            </button>
        </div>
        <div class="form-group col-md-6">
            <div id="divSearch">
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="search" id="txtSearch" name="txtSearch" class="form-control" placeholder="Información para búsqueda (Enter)" autofocus onkeyup="searchDocumentos('{{route('documentos.index')}}', event, false);" value="{{$searchParameter}}">
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            {!! ViewHelper::renderPagination(route('documentos.index'), $quantityPage, $currentPage, 'search='.$searchParameter) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body shadow-lg table-responsive p-0">
                    <table class="table text-nowrap table-striped">
                        <thead>
                            <tr class="bg-lightblue">
                                <th>ID Documento</th>
                                <th>Nombre</th>
                                <th>URL</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $documento)
                            <tr>
                                <td>{{$documento->idDocumento}}</td>
                                <td>{{$documento->nombre}}</td>
                                <td>{{$documento->url}}</td>
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{asset('recursos/documentos/index.js?x='.env('CACHE_LAST_UPDATE'))}}"></script>
    @endpush
</x-app-layout>