<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item" id="mAdmin">
            <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index')?'active':'' }}">
                <i class="nav-icon fas fa-house"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>
        <li class="nav-item" id="mRequerimientos">
            <a href="{{ route('requerimientos.index') }}" class="nav-link {{ request()->routeIs('requerimientos.index')?'active':'' }}">
                <i class="nav-icon fa-sharp fa-solid fa-code-pull-request"></i>
                <p>
                    Requerimientos
                </p>
            </a>
        </li>
        @if (auth()->user()->rol=='super usuario')
            <li class="nav-item">
                <a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->routeIs('usuarios.*')?'active':'' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Usuarios
                    </p>
                </a>
            </li>
        @endif 
    </ul>
</nav>
