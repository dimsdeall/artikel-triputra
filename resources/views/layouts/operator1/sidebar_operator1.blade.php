<aside class="main-sidebar bg-danger elevation-5">
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
                @if (Auth::user()->roles->first()->name == 'Sacon')
                    <li class="nav-item ">
                        <a href="/sacon" class="nav-link text-white {{ setActive(['sacon*']) }}">
                            <i class="nav-icon fas fa-plus"></i>
                            <p>
                                Sacon
                                <i class="right"></i>
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->roles->first()->name == 'Warping & Indigo')
                    <li class="nav-item ">
                        <a data-toggle="modal" data-target="#modal_scan" onclick="$('#status').val('SACON');"
                            class="nav-link text-white {{ setActive(['warping*']) }}" style="cursor: pointer">
                            <i class="nav-icon fas fa-qrcode"></i>
                            <p>
                                Warping
                                <i class="right"></i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a data-toggle="modal" data-target="#modal_scan" onclick="$('#status').val('WARPING');"
                            class="nav-link text-white {{ setActive(['indigo*']) }}" style="cursor: pointer">
                            <i class="nav-icon fas fa-qrcode"></i>
                            <p>
                                Indigo
                                <i class="right"></i>
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->roles->first()->name == 'Weaving')
                    <li class="nav-item ">
                        <a data-toggle="modal" data-target="#modal_scan" onclick="$('#status').val('INDIGO');"
                            class="nav-link text-white {{ setActive(['weaving*']) }}" style="cursor: pointer">
                            <i class="nav-icon fas fa-qrcode"></i>
                            <p>
                                Weaving
                                <i class="right"></i>
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->roles->first()->name == 'Greige')
                    <li class="nav-item ">
                        <a data-toggle="modal" data-target="#modal_scan" onclick="$('#status').val('WEAVING');"
                            class="nav-link text-white {{ setActive(['greige*']) }}" style="cursor: pointer">
                            <i class="nav-icon fas fa-qrcode"></i>
                            <p>
                                Greige
                                <i class="right"></i>
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->roles->first()->name == 'Finish')
                    <li class="nav-item ">
                        <a data-toggle="modal" data-target="#modal_scan" onclick="$('#status').val('GREIGE');"
                            class="nav-link text-white {{ setActive(['finish*']) }}" style="cursor: pointer">
                            <i class="nav-icon fas fa-qrcode"></i>
                            <p>
                                Finish
                                <i class="right"></i>
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
