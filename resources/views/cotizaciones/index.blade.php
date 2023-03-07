<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de cotizaciones de requerimiento ({{$requerimiento->descripcion}})
        </h2>
    </x-slot>
    <div class="row">
        <div class="form-group col-md-6">
            <div id="divSearch">
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="search" id="txtSearch" name="txtSearch" class="form-control" placeholder="Información para búsqueda (Enter)" autofocus onkeyup="searchCotizaciones('{{ route('cotizaciones.index',$requerimiento->idRequerimiento) }}', event, false);" value="{{$searchParameter}}">
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            {!! ViewHelper::renderPagination(route('cotizaciones.index',$requerimiento->idRequerimiento), $quantityPage, $currentPage, 'search='.$searchParameter) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body shadow-lg table-responsive p-0">
                    <table class="table text-nowrap table-striped">
                        <thead>
                            <tr class="bg-lightblue">
                                <th width="30%">Datos generales</th>
                                <th width="20%">Asunto</th>
                                <th width="30%">Observacion</th>
                                <th width="10%">Estado</th>
                                <th width="10%">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $cotizacion)
                            <tr>
                                <td>
                                    <div><small><b>Tipo persona</b> {{ $cotizacion->tipoPersona }}</small></div>
                                    <div>
                                        <small>
                                            <b>{{ $cotizacion->tipoPersona == 'natural' ? 'Nombre' : 'Razon social' }}</b>
                                            {{ $cotizacion->tipoPersona == 'natural' ? $cotizacion->nombre : $cotizacion->razonSocial }}
                                        </small>
                                    </div>
                                    <div>
                                        <small>
                                            <b>{{ $cotizacion->tipoPersona == 'natural' ? 'DNI' : 'RUC' }}</b>
                                            {{ $cotizacion->tipoPersona == 'natural' ? $cotizacion->dni : $cotizacion->ruc }}
                                        </small>
                                    </div>
                                    <div>
                                        <small><b>Telefono</b> {{ $cotizacion->telefono }}</small>
                                    </div>
                                    <div>
                                        <small><b>Correo</b> {{ $cotizacion->correo }}</small>
                                    </div>
                                </td>
                                <td>{{$cotizacion->asunto}}</td>
                                <td>{{$cotizacion->observacion}}</td>
                                <td>{{$cotizacion->estado}}</td>
                                <td align="right">
                                    <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Descargar" onclick="document.getElementById('descargar{{ $cotizacion->idCotizacion }}Cotizacion').submit()">
                                        <i class="fa-solid fa-download"></i> descargar
                                    </button> 
                                    <form id="descargar{{ $cotizacion->idCotizacion }}Cotizacion" action="{{ route('cotizaciones.descargar',[$requerimiento->idRequerimiento,$cotizacion->idCotizacion]) }}" method="POST" hidden>
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
        <script src="{{asset('recursos/cotizaciones/index.js?x='.env('CACHE_LAST_UPDATE'))}}"></script>
    @endpush
</x-app-layout>