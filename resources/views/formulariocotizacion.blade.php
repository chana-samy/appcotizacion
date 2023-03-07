<!DOCTYPE html>
<html lang="es">

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
    <!---alert---->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('plugins/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    
</head>

<body class="layout-top-nav layout-fixed" style="margin: 0;">
    <script>
        $(function() {
            @if (Session::has('globalMessage'))
                @if (Session::get('globalType') == 'error')
                    @foreach (Session::get('globalMessage') as $value)
                        @if (trim($value) != '')
                            toastr.error('{!! $value !!}');
                        @endif
                    @endforeach
                @endif
            @endif
        });
    </script>
    <div class="wrapper" style="background-color: #afc2df;">
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
                    <h1 class="font-weight-bold">COTIZACIONES - UNAMBA</h1>
                </div>
            </div>
            <div class="content">
                <div class="container">
                    <form id="frmCotizacion" method="POST"
                        action="{{ route('cliente.cotizaciones.insertar', $requerimiento->codigo) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card rounded-0">
                            <div class="card-body">
                                <h6 class="font-weight-bold">FORMULARIO DE ENVIÓ DE COTIZACIONES</h6>
                                <p>
                                    Estimados proveedores, para mayor facilidad se ha puesto a su disposición este
                                    formulario, que le permitirá el envío de la oferta económica. Complete sus datos
                                    correctamente. Los campos del formulario con * deben ser llenados obligatoriamente.
                                </p>
                                <div class="form-group">
                                    <label for="">Cotizacion</label>
                                    <div class="border p-2">
                                        {{ $requerimiento->descripcion }}
                                    </div>
                                </div>
                                @if (Session::has('message'))
                                    <div class="alert">
                                        <div class="alert alert-{{ Session::get('type') }}">
                                            <h5><i class="icon fas fa-exclamation-triangle"></i> Cotización!</h5>
                                            {{ Session::get('message') }}.
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selectTipoPersona">Tipo de persona*</label>
                                            <select class="form-control rounded-0" name="selectTipoPersona"
                                                id="selectTipoPersona">
                                                <option value="natural" {{old('selectTipoPersona')=='natural'? 'selected' : ''}}>Persona natural</option>
                                                <option value="juridico" {{old('selectTipoPersona')=='juridico'? 'selected' : ''}}>Persona juridico</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtNombre" id="namePerson">Nombre completo*</label>
                                            <input type="text" id="txtNombre" name="txtNombre" value="{{old('txtNombre')}}"
                                                class="form-control rounded-0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtDocumento" id="documentPerson">DNI*</label>
                                            <input type="text" id="txtDocumento" name="txtDocumento" value="{{old('txtDocumento')}}"
                                                class="form-control rounded-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtTelefono">Telefono*</label>
                                            <input type="text" id="txtTelefono" name="txtTelefono" value="{{old('txtTelefono')}}"
                                                class="form-control rounded-0" placeholder="Telefono">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtCorreo">Correo*</label>
                                            <input type="text" id="txtCorreo" name="txtCorreo" value="{{old('txtCorreo')}}"
                                                class="form-control rounded-0" placeholder="Correo">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Asunto*</label>
                                    <textarea name="txtAsunto" id="txtAsunto" rows="2" class="form-control rounded-0">{{old('txtAsunto')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Observaciones</label>
                                    <textarea name="txtObservacion" id="txtObservacion" rows="3" class="form-control rounded-0">{{old('txtObservacion')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="fileCotizacion">Adjuntar cotizacion*</label>
                                    <input type="file" class="form-control rounded-0" id="fileCotizacion" name="fileCotizacion">
                                </div>
                                <div class="form-group">
                                    <div class="border p-2"><i class="fa-solid fa-file-pdf"></i> &nbsp; &nbsp;
                                        La oferta económica deberá ser entregada en formato digital (PDF). El tamaño máximo del documento escaneado es de 25MB.
                                    </div>
                                    <div class="border p-2"> <i class="fa-sharp fa-solid fa-file-invoice"></i>  &nbsp; &nbsp;
                                        A la oferta económica deberá de adjuntar obligatoriamente los siguientes documentos: DECLARACIÓN JURADA (ANEXO 05), RNP VIGENTE , CCI (CUENTA CORRIENTE INTERBANCARIA HABILITADA OBLIGATORIAMENTE BAJO ANULACIÓN DE PAGO), CONSULTA RUC , CUENTA CORRIENTE DE DETRACCIÓN (DE SER EL CASO).                                       
                                    </div>
                                    <div class="border p-2"><i class="fa-solid fa-file"></i>&nbsp; &nbsp;
                                        En la solicitud de cotizaciones deberán de llenar las condiciones de COMPRA ubicadas en la parte inferior de la solicitud de cotización, con su respectiva Firma y Sello.
                                    </div>
                                    <div class="border p-2"><i class="fa-solid fa-share-from-square"></i> &nbsp; &nbsp;
                                        El envió de las cotizaciones se debe realizar antes de la fecha de entrega y acto público.
                                    </div>
                                </div>
                                <div class="form-group mt-5 d-flex justify-content-between">
                                    <a href="{{ url('/') }}" class="btn btn-secondary rounded-0">Cancelar</a>
                                    <button type="submit" class="btn btn-success rounded-0">Enviar
                                        cotización</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <!-- jAlert -->
    <script src="{{asset('plugins/sweetalert2/dist/sweetalert2.all.js')}}"></script>
    <script src="{{ asset('recursos/cotizaciones/insert.js?x='.env('CACHE_LAST_UPDATE')) }}"></script>
    
</body>

</html>
