<aside class="main-sidebar bg-success elevation-5">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">TRIPUTRA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="/" class="nav-link text-white {{ setActive(['/', 'home']) }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right"></i>
                        </p>
                    </a>
                </li>
                @if (Auth::user()->roles->first()->name == 'Admin Warping & Indigo')
                    <li class="nav-item">
                        <a href="{{ route('warping.index') }}" class="nav-link {{ setActive(['warping*']) }}">
                            <i class="fa fa-qrcode nav-icon text-white "></i>
                            <p class="text-white ">Warping</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('indigo.index') }}" class="nav-link {{ setActive(['indigo*']) }}">
                            <i class="fa fa-qrcode nav-icon text-white "></i>
                            <p class="text-white ">Indigo</p>
                        </a>
                    </li>
                @elseif (Auth::user()->roles->first()->name == 'Admin Weaving')
                    <li class="nav-item">
                        <a href="{{ route('weaving.index') }}" class="nav-link {{ setActive(['weaving*']) }}">
                            <i class="fa fa-qrcode nav-icon text-white "></i>
                            <p class="text-white ">Weaving</p>
                        </a>
                    </li>
                @elseif (Auth::user()->roles->first()->name == 'Admin Greige')
                    <li class="nav-item">
                        <a href="{{ route('greige.index') }}" class="nav-link {{ setActive(['greige*']) }}">
                            <i class="fa fa-qrcode nav-icon text-white "></i>
                            <p class="text-white ">Geige</p>
                        </a>
                    </li>
                @elseif (Auth::user()->roles->first()->name == 'Admin Finish')
                    <li class="nav-item">
                        <a href="{{ route('finish.index') }}" class="nav-link {{ setActive(['finish*']) }}">
                            <i class="fa fa-qrcode nav-icon text-white "></i>
                            <p class="text-white ">Finish</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
