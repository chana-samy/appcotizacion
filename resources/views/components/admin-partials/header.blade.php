<nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-3">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
        <!-- Notifications Dropdown Menu -->
       
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ Auth::user()->foto==''? asset('img/user.png' ):asset('storage/'.Auth::user()->foto) }}" class="user-image img-circle elevation-2" alt="{{ Auth::user()->name }}">
            </a>
            {{-- User menu dropdown --}}
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                {{-- User menu header --}}
                <li class="user-header  bg-primary">
                    <img src="{{ Auth::user()->foto==''? asset('img/user.png' ):asset('storage/'.Auth::user()->foto) }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                    <p>
                        {{ Auth::user()->nombre.' '.Auth::user()->apellido }}
                        <small>{{Auth::user()->rol}}</small>
                    </p>
                </li>
                {{-- User menu footer --}}
                <li class="user-footer">
                    <a href="{{route('usuarios.perfil')}}" class="btn btn-default btn-flat " >
                        <i class="fa fa-fw fa-user text-lightblue"></i>
                        Perfil
                    </a>
                    <a class="btn btn-default btn-flat float-right"
                       href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-power-off text-red"></i>
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
       
    </ul>
</nav>
