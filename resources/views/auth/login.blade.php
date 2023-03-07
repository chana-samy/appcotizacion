<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Abastecimiento</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('recursos/login/style.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        .bg-img{
            background-image: linear-gradient(rgb(107, 126, 160,0.5), rgba(129, 151, 192, 0.5)), url('{{asset('recursos/login/img/loginfondo.jpg')}}');
            background-repeat: no-repeat;
            background-size:cover;
            background-position:center;
        }
    </style>
    <!-- jQuery -->
    <script src="{{ asset('plugins/adminlte/plugins/jquery/jquery.min.js') }}"></script>
  </head>

<body class="font-sans text-gray-900 antialiased">
    <script>
        $(function()
        {
          @if(Session::has('globalMessage'))
            @if(Session::get('type')=='error')
              @foreach(Session::get('globalMessage') as $value)
                @if(trim($value)!='')
                    toastr.error('{{ $value }}');
                @endif
              @endforeach
            @endif
        @endif  
        });
    </script>
    <div class="auth-container bg-img"  >
        <div class="auth-card">
            <div class="form-section">
                <div class="user-logo mb-8">
                    <img src="{{ asset('recursos/login/img/logo.png') }}" alt="logo unamba">
                    <h1>
                        COTIZACIONES
                    </h1>
                </div>
                <form method="POST" autocomplete="off"  action="{{ route('login')}}">
                    @csrf 
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa-solid fa-envelope input-group-icon"></i>
                            </div>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Usuario">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa-solid fa-user-lock input-group-icon"></i>
                            </div>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
                        </div>
                    </div>
                    <button type="submit" class="btn-login mt-6">
                        Iniciar sesión
                    </button>
                </form>
                
            </div>
        </div>
    </div>
    <!-- toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
</body>

</html>