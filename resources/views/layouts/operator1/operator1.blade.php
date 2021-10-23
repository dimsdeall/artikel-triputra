<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/../plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/../dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/../plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('/../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{ asset('/../plugins/jquery/jquery.min.js') }}"></script>

    {{-- pace --}}
    <script src="{{ asset('/pace/pace.js') }}"></script>
    <link href="{{ asset('/pace/themes/blue/pace-theme-loading-bar.css') }}" rel="stylesheet" />

</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-navbar-fixed layout-fixed ">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-danger navbar-light ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" data-widget="pushmenu" href="/"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    @guest
                    @else
                        <a class="nav-link dropdown-toggle text-white" id="UserDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="profile-text text-white">Hai, {{ Auth::user()->name }} !</span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                         document.getElementById('logout-form').submit();">
                                Keluar

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </a>
                        </div>
                    @endguest
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @section('sidebar')
            @include('layouts.operator1.sidebar_operator1')
        @show

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!-- /.content-wrapper -->
        {{-- @section('footer')
        @include('layouts.operator1.footer_operator1')
        @show --}}


    </div>
    <!-- ./wrapper -->


    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/../plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- SweetAlert -->
    <script src="{{ asset('/../js/sweetalert2.all.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('/../plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/../plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/../plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/../dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/../dist/js/demo.js') }}"></script>
</body>

<div class="modal fade" id="modal_scan">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title">Scan Barcode Sesuai KP</h4>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="row">
                        <div class="col-8 col-lg-10">
                            <div class="form-group">
                                <input type="hidden" id="status">
                                <input type="text" id="barcodeid" name="barcodeid" class="form-control"
                                    placeholder="example: B22143DSA" required style="text-transform: uppercase"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-2 col-lg-2">
                            <button type="submit" class="btn btn-primary" onclick="cek_barcode();">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modal_scan').on('shown.bs.modal', function() {
        $('input[name="barcodeid"]').focus();
    });

    function cek_barcode() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000
        });
        let res = $('#barcodeid').val().split('|');

        if (res[1] == null || res[1] == '') {
            $('#barcodeid').val('');
            return Toast.fire({
                type: 'error',
                title: 'data tidak ditemukan!'
            })
        } else if (res[1].toUpperCase() != $('#status').val()) {
            $('#barcodeid').val('');
            return Toast.fire({
                type: 'error',
                title: 'data barcode bukan divisi ini!'
            })
        }


        $.ajax({
            type: 'POST',
            url: '/cekbarcode',
            data: {
                _token: "{{ csrf_token() }}",
                status: $('#status').val(),
                kp: res[0]
            },
            success: function(data) {
                if (data == 'null') {
                    $('#barcodeid').val('');
                    return Toast.fire({
                        type: 'error',
                        title: 'data tidak ditemukan!'
                    })
                } else {
                    window.location.href = data;
                }
            },
            error: function(xhr) {
                //Do Something to handle error
                alert(xhr.responseText);
            }
        });
    }

    $('#barcodeid').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
            return cek_barcode();
        }
    });

</script>

</html>
