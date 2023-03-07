<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@stack('title')</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
     <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/select2/css/select2.min.css') }}">
    <!-- select2-bootstrap4-theme -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- pnotify -->
    <link rel="stylesheet" href="{{ asset('plugins/pnotify/pnotify.custom.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @stack('css')
 
    <!-- jQuery -->
    <script src="{{ asset('plugins/adminlte/plugins/jquery/jquery.min.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <script>
        $(function()
        {
          @if(Session::has('globalMessage'))
            @if(Session::get('type')=='error' || Session::get('type')=='exception')
              @foreach(Session::get('globalMessage') as $value)
                @if(trim($value)!='')
                  new PNotify(
                    {
                      title : 'No se pudo proceder',
                      text : '{{$value}}',
                      type : 'error'
                    });
                @endif
              @endforeach
            @else
                swal.fire(
                  {
                    title: '{{Session::get('type')=='success' ? 'Correcto' : 'Alerta'}}',
                    text: '{!!Session::get('globalMessage')[0]!!}',
                    icon: '{{Session::get('type')}}',
                    timer: '{{Session::get('type')=='success' ? '3000': '8000'}}',
                  });
            @endif
        @endif  
        });
    </script>
    <div class="wrapper">
        <div id="modalLoading" style="display: none;">
            <div>
                <div>
                    <div>
                        <img src="{{asset('img/loader.svg')}}" width="70%">
                    </div>
                </div>
            </div>
        </div>    
        <!-- Preloader -->
        {{-- <div class="preloader ">
            <img class="" src="{{ asset('img/loader.svg') }}" alt="AdminLTELogo" height="100" width="100">
        </div> --}}
        <!-- Navbar -->
        <x-admin-partials.header />
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-olive elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.index') }}" class="brand-link">
                <img src="{{ asset('img/logounamba.png') }}" alt="unamba Logo" class="brand-image  elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">COTIZACIONES</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
              
                <x-admin-partials.menu />
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper ">
            <!-- Content Header (Page header) -->
            @if (isset($header))
                <div class="content-header">
                    <div class="container-fluid">
                        {{ $header }}
                    </div>
                </div>
            @endif
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div id="divGeneralContainer"></div>
                {{-- pr-0 pr-sm-2 pr-md-3 --}}
                <div class="container-fluid py-4">
                    {{ $slot }}
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Footer -->
        <x-admin-partials.footer />
        <!-- /.footer -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
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
    <!-- ChartJS -->
    <script src="{{ asset('plugins/adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/adminlte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/plugins/moment/locales.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('plugins/adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!--select2-->
    <script src="{{ asset('plugins/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/plugins/select2/js/i18n/es.js') }}"></script>
    <!-- Form-validation -->
    <script src="{{ asset('plugins/formvalidation/formValidation.min.js') }}"></script>
    <script src="{{ asset('plugins/formvalidation/bootstrap.validation.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('plugins/sweetalert2/dist/sweetalert2.all.js')}}"></script>
    <!-- Pnotify -->
    <script src="{{asset('plugins/pnotify/pnotify.custom.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    
    <!-- Platform Helpers -->
    <script src="{{asset('js/helpers.js?x='.env('CACHE_LAST_UPDATE'))}}"></script>
    <script src="{{asset('js/app.js?x='.env('CACHE_LAST_UPDATE'))}}"></script>
    
    @stack('js')
</body>
</html>