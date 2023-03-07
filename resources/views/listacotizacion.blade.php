<!DOCTYPE html>
<html lang="es" style="background-color: #afc2df;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cotizaciones - UNAMBA</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/dist/css/adminlte.min.css') }}">
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        #table-cotizacion th,
        td {
            word-wrap: break-word;
            max-width: 250px;
        }
    </style>
    <!-- jQuery -->
    <script src="{{ asset('plugins/adminlte/plugins/jquery/jquery.min.js') }}"></script>
</head>

<body class="layout-top-nav layout-fixed" style="margin: 0;">
    <div class="wrapper" style="background-color: #afc2df; height: 100%;">
        <div id="modalLoading" style="display: none;">
            <div>
                <div>
                    <div>
                        <img src="{{ asset('img/loader.svg') }}" width="70%">
                    </div>
                </div>
            </div>
        </div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-1">
            <div class="container">
                <div class="navbar-brand">
                    <img src="https://bolsadetrabajo.unamba.edu.pe/img/login/unamba.png" class=""
                        style="width:200px;" alt="">
                </div>
                <div class="ml-auto">
                    UNAMBA
                </div>
            </div>
        </nav>
        <div class="container-wrapper">
            <div class="content-header">
                <div class="container">
                    <h1 class="font-weight-bold">LISTA - COTIZACIONES - UNAMBA</h1>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid px-md-3 px-lg-5">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <form id="frmCotizacion" method="GET" action="{{ route('cotizaciones.lista') }}">
                                <div class="row">

                                    <div class="col-sm-6 col-lg-4 form-group">
                                        <label for="txtAño">Año*</label>
                                        <input type="text" id="txtAño" name="anio"
                                            class="form-control rounded-0" placeholder="Año"
                                            value="{{ $anio }}">
                                    </div>
                                    <div class="col-sm-6 col-lg-4 form-group">
                                        <label for="txtCorreo">Estado*</label>
                                        <select class="form-control rounded-0" name="estado" id="selectEstado">
                                            <option value="vigente" {{ $estado == 'vigente' ? 'selected' : '' }}>Vigente
                                            </option>
                                            <option value="cerrado" {{ $estado == 'cerrado' ? 'selected' : '' }}>Cerrado
                                            </option>
                                            <option value="todo" {{ $estado == 'todo' ? 'selected' : '' }}>Mostrar
                                                todo</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 form-group">
                                        <label for="">&nbsp;</label>
                                        <button type="submit"
                                            class="btn btn-success rounded-0 btn-block">Buscar</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="table-cotizacion" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="5%">N°</th>
                                                    <th width="60%">Descripcion cotización</th>
                                                    <th width="10%">Fecha límite de entrega</th>
                                                    <th width="20%" style="text-align: center;">opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($requerimientos as $requerimiento)
                                                    <tr>
                                                        <td>{{ $requerimiento->codigo }}</td>
                                                        <td>
                                                            <p class="align-text-justify mb-0">
                                                                {{ $requerimiento->descripcion }}
                                                            </p>
                                                            <small><b>Fecha de publicacion :
                                                                </b>{{ date('d/m/Y H:i', strtotime($requerimiento->created_at)) }}</small>
                                                        </td>
                                                        <td>{{ date('d/m/Y H:i', strtotime($requerimiento->fechaCierre)) }}
                                                        </td>
                                                        <td>
                                                            <button
                                                                class="btn btn-primary btn-block rounded-0" onclick="objetenerDocumentos('{{ $requerimiento->codigo }}')">Descargar</button>
                                                            @if ($requerimiento->vigente)
                                                                <a class="btn btn-success btn-block rounded-0"
                                                                    href="{{ route('cliente.cotizaciones.insertar', $requerimiento->codigo) }}">Enviar
                                                                    cotización</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex d-sm-block justify-content-end">
                                            {{ $requerimientos->onEachSide(1)->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}

    <div class="modal fade" id="documentModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Documentos:</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modalDocumentsBody">
                    
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ./wrapper -->
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('plugins/adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- Jqyery validation -->
    <script src="{{ asset('plugins/adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        const objetenerDocumentos = (codigo) => {
            let url = `{{ route('cliente.cotizaciones.listadocumentos',':codigo') }}`;
            url = url.replace(':codigo', codigo);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#modalDocumentsBody').html(response);
                    $('#documentModal').modal('show');
                },
                error: function (error) {
                    toastr.error(error.responseJSON.message);
                }
            });
        }
    </script>
</body>

</html>
