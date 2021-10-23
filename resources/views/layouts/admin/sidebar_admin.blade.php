<aside class="main-sidebar bg-info elevation-5">
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
          {{-- <li class="nav-item ">
            <a href="/sacon" class="nav-link text-white {{ setActive(['sacon*']) }}">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Sacon
                <i class="right"></i>
              </p>
            </a>
          </li>  --}}
          <li class="nav-item ">
            <a href="/laporanadmin" class="nav-link text-white {{ setActive(['laporanadmin*']) }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Laporan
                <i class="right"></i>
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="/user" class="nav-link text-white {{ setActive(['user*']) }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage User
                <i class="right"></i>
              </p>
            </a>
          </li>     
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>