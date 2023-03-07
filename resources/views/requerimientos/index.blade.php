<x-app-layout>
    <div class="row">
        <div class="col-md-1">
            <button class="btn bg-olive btn-sm elevation-3" data-toggle="tooltip" data-placement="right"
                title="Agregar requerimiento"
                onclick="ajaxDialog('divGeneralContainer', 'modal-lg', 'Insertar Nuevo Requerimiento', null, '{{route('requerimientos.insertar')}}', 'GET', null, null, false, true);">
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
                    <input type="search" id="txtSearch" name="txtSearch" class="form-control" placeholder="Información para búsqueda (Enter)" autofocus onkeyup="searchRequerimientos('{{route('requerimientos.index')}}', event, false);" value="{{$searchParameter}}">
                </div>
            </div>
        </div>
        <div class="form-group col-md-5">
            {!! ViewHelper::renderPagination(route('requerimientos.index'), $quantityPage, $currentPage, 'search='.$searchParameter) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body shadow-lg table-responsive p-0">
                    <table class="table text-nowrap table-striped">
                        <thead>
                            <tr class="bg-lightblue">
                                <th>Descripcion</th>
                                <th>Fecha Publicación</th>
                                <th>Fecha Cierre</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $requerimiento)
                            <tr>
                                <td>{{$requerimiento->descripcion}}</td>
                                <td>{{$requerimiento->created_at}}</td>
                                <td>{{$requerimiento->fechaCierre}}</td>
                                <td align="right">
                                    <button class="btn bg-pink btn-sm px-1 py-0" data-toggle="tooltip" data-placement="left" title="Administrar documentos" onclick="_globalFunction.clickLink('{{ route('requerimientos.administrarDocumentos',$requerimiento->idRequerimiento) }}')">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </button> 
                                    <button class="btn btn-info btn-sm px-1 py-0" data-toggle="tooltip" data-placement="left" title="Ver cotizaciones" onclick="_globalFunction.clickLink('{{ route('cotizaciones.index',$requerimiento->idRequerimiento) }}')">
                                        <i class="fa-solid fa-folder-open"></i>
                                    </button> 
                                    <button class="btn btn-success btn-sm px-1 py-0" data-toggle="tooltip" data-placement="left" title="Editar" onclick="ajaxDialog('divGeneralContainer', 'modal-lg', 'Editar requerimiento', null, '{{ route('requerimientos.editar',$requerimiento->idRequerimiento) }}', 'GET', null, null, false, true);">
                                        <i class="fa-solid fa-edit"></i>
                                    </button> 
                                    <button class="btn btn-danger btn-sm px-1 py-0" data-toggle="tooltip" data-placement="left" title="Eliminar" onclick="confirmDialogSend('delete{{ $requerimiento->idRequerimiento }}Requerimiento')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button> 
                                    <form id="delete{{ $requerimiento->idRequerimiento }}Requerimiento" action="{{ route('requerimientos.eliminar',$requerimiento->idRequerimiento) }}" method="POST" hidden>
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
        <script src="{{asset('recursos/requerimientos/index.js?x='.env('CACHE_LAST_UPDATE'))}}"></script>
    @endpush
</x-app-layout>