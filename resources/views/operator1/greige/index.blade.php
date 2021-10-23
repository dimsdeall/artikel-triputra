@extends('layouts.operator1.operator1')
@section('title', 'Operator1 | Greige')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#greige-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                method: 'GET',
                ajax: "{{ URL::to('/greige/operator1/getdata/' . $sacon->id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kp',
                        name: 'kp'
                    },
                    {
                        data: 'item',
                        name: 'item'
                    },
                    {
                        data: 'shift',
                        name: 'shift'
                    },
                    {
                        data: 'weaving.nb',
                        name: 'weaving.nb'
                    },
                    {
                        data: 'potongan',
                        name: 'potongan'
                    },
                    {
                        data: 'p',
                        name: 'p'
                    },
                    {
                        data: 'b',
                        name: 'b'
                    },
                    {
                        data: 'sn',
                        name: 'sn'
                    },
                    {
                        data: 'grade',
                        name: 'grade'
                    },
                    {
                        data: 'opr',
                        name: 'opr'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'print',
                        name: 'print'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ]
            });

            $('#weaving-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                method: 'GET',
                ajax: "{{ URL::to('/weaving/operator1/getdata/' . $sacon->id) }}",
                columns: [{
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'pitem',
                        name: 'pitem'
                    },
                    {
                        data: 'lot',
                        name: 'lot'
                    },
                    {
                        data: 'mc',
                        name: 'mc'
                    },
                    {
                        data: 'nb',
                        name: 'nb'
                    },
                    {
                        data: 'pakan',
                        name: 'pakan'
                    },
                    {
                        data: 'pick',
                        name: 'pick'
                    },
                    {
                        data: 'sisir',
                        name: 'sisir'
                    },
                    {
                        data: 'anyaman',
                        name: 'anyaman'
                    },
                    {
                        data: 'potongan',
                        name: 'potongan'
                    },
                    {
                        data: 'p',
                        name: 'p'
                    },
                    {
                        data: 'b',
                        name: 'b'
                    },
                    {
                        data: 'shift',
                        name: 'shift'
                    },
                    {
                        data: 'sn',
                        name: 'sn'
                    },
                    {
                        data: 'opr',
                        name: 'opr'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'print',
                        name: 'print'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ],
                columnDefs: [{
                    targets: 0,
                    className: 'text-center',
                }]
            });
        });

    </script>

@section('content')
    <div class="col-md-12 col-sm-12 pt-2">
        <div class="card card-info card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item col-6">
                        <a class="nav-link active" id="custom-tabs-one-weaving-tab" data-toggle="pill"
                            href="#custom-tabs-one-weaving" role="tab" aria-controls="custom-tabs-one-weaving"
                            aria-selected="true">Weaving</a>
                    </li>
                    <li class="nav-item col-6">
                        <a class="nav-link" id="custom-tabs-one-greige-tab" data-toggle="pill"
                            href="#custom-tabs-one-greige" role="tab" aria-controls="custom-tabs-one-greige"
                            aria-selected="false">Greige</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-weaving" role="tabpanel"
                        aria-labelledby="custom-tabs-one-weaving-tab">
                        <div class="row">
                            <div class="col-sm-2 col-2">
                                <label>KP</label>
                            </div>
                            <div class="col-sm-10 col-10">
                                <label>{{ ': ' . $sacon->kp }}</label>
                            </div>
                            <div class="col-sm-2 col-2">
                                <label>Item</label>
                            </div>
                            <div class="col-sm-10 col-10">
                                <label>{{ ': ' . $sacon->item }}</label>
                            </div>
                            <div class="col-sm-6 col-8">
                                <input type="text" id="barcode" name="barcode" class="form-control"
                                    style="text-transform: uppercase" placeholder="Scan Barcode">
                            </div>
                            <div class="col-sm-4 col-4 pb-2">
                                <button class="btn btn-primary btn-lg" onclick="checkbarcode()"><i
                                        class="fa fa-search"></i></button>
                            </div>
                            <div class="table-responsive">
                                <table id="weaving-table" class="table table-sm table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                P Item
                                            </th>
                                            <th>
                                                LOT
                                            </th>
                                            <th>
                                                MC
                                            </th>
                                            <th>
                                                No Beam
                                            </th>
                                            <th>
                                                Pakan
                                            </th>
                                            <th>
                                                Pick
                                            </th>
                                            <th>
                                                Sisir
                                            </th>
                                            <th>
                                                Anyaman
                                            </th>
                                            <th>
                                                Potongan
                                            </th>
                                            <th>
                                                Panjang
                                            </th>
                                            <th>
                                                Berat
                                            </th>
                                            <th>
                                                Shift
                                            </th>
                                            <th>
                                                SN
                                            </th>
                                            <th>
                                                OPR
                                            </th>
                                            <th>
                                                Author
                                            </th>
                                            <th>
                                                Print
                                            </th>
                                            <th>
                                                Tanggal
                                            </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                P Item
                                            </th>
                                            <th>
                                                LOT
                                            </th>
                                            <th>
                                                MC
                                            </th>
                                            <th>
                                                No Beam
                                            </th>
                                            <th>
                                                Pakan
                                            </th>
                                            <th>
                                                Pick
                                            </th>
                                            <th>
                                                Sisir
                                            </th>
                                            <th>
                                                Anyaman
                                            </th>
                                            <th>
                                                Potongan
                                            </th>
                                            <th>
                                                Panjang
                                            </th>
                                            <th>
                                                Berat
                                            </th>
                                            <th>
                                                Shift
                                            </th>
                                            <th>
                                                SN
                                            </th>
                                            <th>
                                                OPR
                                            </th>
                                            <th>
                                                Author
                                            </th>
                                            <th>
                                                Print
                                            </th>
                                            <th>
                                                Tanggal
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-greige" role="tabpanel"
                        aria-labelledby="custom-tabs-one-greige-tab">
                        <div class="row">
                            <input type="hidden" id="kp" name="kp" value="{{ $_GET['kp'] }}">
                            <div class="table-responsive">
                                <table id="greige-table" class="table table-sm table-striped table-bordered nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>
                                                no
                                            </th>
                                            <th>
                                                KP
                                            </th>
                                            <th>
                                                Item
                                            </th>
                                            <th>
                                                Shift
                                            </th>
                                            <th>
                                                No Beam
                                            </th>
                                            <th>
                                                Potongan
                                            </th>
                                            <th>
                                                Panjang
                                            </th>
                                            <th>
                                                Berat
                                            </th>
                                            <th>
                                                SN
                                            </th>
                                            <th>
                                                Grade
                                            </th>
                                            <th>
                                                OPR
                                            </th>
                                            <th>
                                                Author
                                            </th>
                                            <th>
                                                Print
                                            </th>
                                            <th>
                                                Tanggal
                                            </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>
                                                no
                                            </th>
                                            <th>
                                                KP
                                            </th>
                                            <th>
                                                Item
                                            </th>
                                            <th>
                                                Shift
                                            </th>
                                            <th>
                                                No Beam
                                            </th>
                                            <th>
                                                Potongan
                                            </th>
                                            <th>
                                                Panjang
                                            </th>
                                            <th>
                                                Berat
                                            </th>
                                            <th>
                                                SN
                                            </th>
                                            <th>
                                                Grade
                                            </th>
                                            <th>
                                                OPR
                                            </th>
                                            <th>
                                                Author
                                            </th>
                                            <th>
                                                Print
                                            </th>
                                            <th>
                                                Tanggal
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" id="blank_modal" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Result</h4>
                </div>
                <div class="modal-body">
                    Data tidak di temukan . . .
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss='modal' onclick="$('#barcode').focus();"> OK </button>
                </div>
            </div>
        </div>
    </div>

    <form id="form-greige" action="{{ route('greige.create') }}" method="GET">
        <input type="hidden" id="kp" name="kp" id="barcodeitem" value="{{ $_GET['kp'] }}">
    </form>

    <script>
        $('#barcode').keypress(function(e) {
            var key = e.which;
            if (key == 13) // the enter key code
            {
                return checkbarcode();
            }
        });

        function checkbarcode() {
            let barcode = $('#barcode').val();
            let res = barcode.split("|");
            let kp_val = res[0];
            let status = res[1];
            let id_val = res[2];

            if ((kp_val == '') || (id_val == null) || (id_val == '') || (status.toUpperCase() != 'WEAVING')) {
                $('#blank_modal').modal('show')
                return true;
            }


            $.ajax({
                type: 'POST',
                url: '/cekbarcode/weaving',
                data: {
                    _token: "{{ csrf_token() }}",
                    kp: kp_val,
                    id: id_val
                },
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    console.log(data);
                    let res = data.split('|');

                    if (res[0] == 'ok') {
                        $('#weaving-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Verifikasi Berhasil!',
                            text: "Lanjut mengisi data?",
                            type: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Lanjut',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.value == true) {
                                window.open(res[1],'_self');
                            }
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: 'verification failed!'
                        })
                    }
                    $('#barcode').val('');
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });
        };

        function checkweaving() {
            console.log('test');
            let sacon_id = "{{ $sacon->id }}";
            $.ajax({
                type: 'POST',
                url: '/weaving/status/check',
                data: {
                    _token: "{{ csrf_token() }}",
                    sacon: sacon_id
                },
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if (data == 'ok') {
                        $('#form-greige').submit();
                    } else {
                        Toast.fire({
                            type: 'info',
                            title: 'verification not complete!'
                        })
                    }
                    $('#barcode').val('');
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });
        };

    </script>
@endsection
