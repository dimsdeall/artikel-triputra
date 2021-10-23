<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tri Putra Web Apps</title>
    <!-- Tell the browser to be responsive to screen width -->
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
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{ asset('/../plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#finish-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                method: 'GET',
                ajax: "{{ URL::to('/finishtemp/getdata') }}",
                columns: [{
                        data: 'kp',
                        name: 'kp'
                    },
                    {
                        data: 'item',
                        name: 'item'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'potongan',
                        name: 'potongan'
                    },
                    {
                        data: 'lot',
                        name: 'lot'
                    },
                    {
                        data: 'grade',
                        name: 'grade'
                    },
                    {
                        data: 'point',
                        name: 'point'
                    },
                    {
                        data: 'yds',
                        name: 'yds'
                    },
                    {
                        data: 'kg',
                        name: 'kg'
                    },
                    {
                        data: 'lebar',
                        name: 'lebar'
                    },
                    {
                        data: 'sn',
                        name: 'sn'
                    },
                    {
                        data: 'k3l',
                        name: 'k3l'
                    },
                    {
                        data: 'inisial',
                        name: 'inisial'
                    },
                    {
                        data: 'susutlusi',
                        name: 'susutlusi'
                    },
                    {
                        data: 'k',
                        name: 'k'
                    },
                    {
                        data: 'actual',
                        name: 'actual'
                    },
                    {
                        data: 'tgl',
                        name: 'tgl'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

    </script>
</head>

<body style="background-color: #33b5e5">
    <div class="col-sm-12 pt-2">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title text-white">Export Excel Finish</h3>
                <a href="/login" class="btn btn-primary btn-sm float-right">Login</a>
            </div>
            <div class="card-body">
                <div class="col-sm-4 float-left row p-1">
                    <input type="text" name="cekbarcode" id="cekbarcode" onete class="form-control col-sm-7 m-1"
                        autocomplete="off" style="text-transform: uppercase">
                    <button type="submit" onclick="checkbarcode()" class="btn btn-primary col-sm-4 m-1">Cek
                        Barcode</button>
                </div>
                <div class="col-sm-4 float-right p-1">
                    <a href="/finishtemp/export" class="btn btn-success float-right ml-1"><i
                            class="fa fa-file-excel"></i> Export</a>
                    <button type="submit" class="btn btn-danger float-right" onclick="truncatebarcode()"><i
                            class="fa fa-trash-alt"></i> Truncate</button>
                </div>
                <div class="table-responsive">
                    <table id="finish-table" class="table table-sm table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>
                                    KP
                                </th>
                                <th>
                                    Item
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Potong
                                </th>
                                <th>
                                    LOT
                                </th>
                                <th>
                                    Grade
                                </th>
                                <th>
                                    Point
                                </th>
                                <th>
                                    YDS
                                </th>
                                <th>
                                    KG
                                </th>
                                <th>
                                    Lebar
                                </th>
                                <th>
                                    SN
                                </th>
                                <th>
                                    K3l
                                </th>
                                <th>
                                    Inisial
                                </th>
                                <th>
                                    Susut Lusi
                                </th>
                                <th>
                                    K
                                </th>
                                <th>
                                    Actual
                                </th>
                                <th>
                                    TGL
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /.login-box -->

    <div class="modal fade" id="blankmodal" index='123'>
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Result</h4>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        Data Item ini tidak ditemukan. . .
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="$( '#cekbarcode' ).focus();$( '#cekbarcode' ).val(''); "
                        data-dismiss="modal">OK</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="alreadymodal" index='123'>
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Result</h4>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        Data sudah ada ! ! !
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="$( '#cekbarcode' ).focus();$( '#cekbarcode' ).val(''); "
                        data-dismiss="modal">OK</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- jQuery -->
    <script src="{{ asset('/../plugins/jquery/jquery.min.js') }}"></script>
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
    @include('sweetalert::alert')

    <script>
        $("#cekbarcode").focus();

        function checkbarcode() {
            let datas = document.getElementById('cekbarcode').value;
            data = datas.split("|");

            console.log(data);

            if (data[2] == '' || data[2] == null) {
                $('#blankmodal').modal('show');
                return true;
            }


            $.ajax({
                type: 'POST',
                url: '/finishtemp',
                data: {
                    _token: "{{ csrf_token() }}",
                    sacon: data[0],
                    id: data[2]
                },
                success: function(data) {
                    if (data == 'done') {
                        $('#cekbarcode').val('');
                        $('#finish-table').DataTable().ajax.reload();
                    } else if (data == 'already') {
                        $('#alreadymodal').modal('show');
                    } else {
                        $('#blankmodal').modal('show');
                    }
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });
        }

        function deletebarcode(id) {
            $.ajax({
                type: 'POST',
                url: '/finishtemp/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(data) {
                    if (data == 'done') {
                        $('#finish-table').DataTable().ajax.reload();
                    }
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });
        }

        function truncatebarcode() {
            $.ajax({
                type: 'POST',
                url: '/finishtemp/truncate',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data == 'done') {
                        $('#finish-table').DataTable().ajax.reload();
                    }
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });
        }

        $('#cekbarcode').keypress(function(e) {
            var key = e.which;
            if (key == 13) // the enter key code
            {
                return checkbarcode();
            }
        });

    </script>

</body>

</html>
