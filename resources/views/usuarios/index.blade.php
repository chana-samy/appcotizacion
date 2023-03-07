<x-app-layout>
    <div class="row">
        <div class="col-md-1">
            <button class="btn bg-olive btn-sm elevation-3" data-toggle="tooltip" data-placement="right"
                title="Agregar requerimiento"
                onclick="ajaxDialog('divGeneralContainer', 'modal-lg', 'Insertar nuevo usuario', null, '{{route('usuarios.insertar')}}', 'GET', null, null, false, true);">
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
                    <input type="search" id="txtSearch" name="txtSearch" class="form-control" placeholder="Información para búsqueda (Enter)" autofocus onkeyup="searchRequerimientos('', event, false);" value="{{$searchParameter}}">
                </div>
            </div>
        </div>
        <div class="form-group col-md-5">
            {!! ViewHelper::renderPagination(route('usuarios.index'), $quantityPage, $currentPage, 'search='.$searchParameter) !!}
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
                                <th>Correo</th>
                                <th>DNI</th>
                                <th>rol</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $usuario)
                            <tr>
                                <td>{{$usuario->nombre.' '.$usuario->apellido}}</td>
                                <td>{{$usuario->correo}}</td>
                                <td>{{$usuario->dni}}</td>
                                <td>{{$usuario->rol}}</td>
                                <td>
                                    <span class="badge bg-{{ $usuario->estado == 'habilitado' ? 'olive':'maroon' }}">{{$usuario->estado}}</span>
                                </td>
                                <td align="right">
                                    <button class="btn btn-success btn-sm px-1 py-0" data-toggle="tooltip" data-placement="left" title="Editar" onclick="ajaxDialog('divGeneralContainer', 'modal-lg', 'Editar usuario', null, '{{ route('usuarios.editar',$usuario->idUsuario) }}', 'GET', null, null, false, true);">
                                        <i class="fa-solid fa-edit"></i>
                                    </button> 
                                    <button class="btn btn-{{ $usuario->estado == 'habilitado' ? 'danger':'primary' }} btn-sm px-1 py-0" data-toggle="tooltip" data-placement="left" title="{{ $usuario->estado == 'habilitado' ? 'Suspender acceso':'Habilitar acceso' }}" onclick="confirmDialogSend('cambiar{{ $usuario->idUsuario }}Usuario')">
                                        <i class="fa-solid fa-{{ $usuario->estado == 'habilitado' ? 'ban':'check' }}"></i>
                                    </button> 
                                    <form id="cambiar{{ $usuario->idUsuario }}Usuario" action="{{ route('usuarios.cambiarestado',$usuario->idUsuario) }}" method="POST" hidden>
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