@extends('layouts.operator2.operator2')
@section('title', 'Operator2 | Sacon')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sacon-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                method: 'GET',
                ajax: "{{ URL::to('/sacon/admin/getdata') }}",
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
                        data: 'lot',
                        name: 'lot'
                    },
                    {
                        data: 'lusi',
                        name: 'lusi'
                    },
                    {
                        data: 'ball1',
                        name: 'ball1'
                    },
                    {
                        data: 'kg1',
                        name: 'kg1'
                    },
                    {
                        data: 'cones1',
                        name: 'cones1'
                    },
                    {
                        data: 'pakan',
                        name: 'pakan'
                    },
                    {
                        data: 'ball2',
                        name: 'ball2'
                    },
                    {
                        data: 'kg2',
                        name: 'kg2'
                    },
                    {
                        data: 'cones2',
                        name: 'cones2'
                    },
                    {
                        data: 'sisir',
                        name: 'sisir'
                    },
                    {
                        data: 'te',
                        name: 'te'
                    },
                    {
                        data: 'w',
                        name: 'w'
                    },
                    {
                        data: 'p',
                        name: 'p'
                    },
                    {
                        data: 'susut',
                        name: 'susut'
                    },
                    {
                        data: 'actual',
                        name: 'actual'
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
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        $(document).on('click', '#editmodal', function() {
            $('#sacon_kp').val($(this).data('kp'));
            $('#sacon_item').val($(this).data('item'));
            $('#sacon_lot').val($(this).data('lot'));
            $('#sacon_lusi').val($(this).data('lusi'));
            $('#sacon_ball1').val($(this).data('ball1'));
            $('#sacon_kg1').val($(this).data('kg1'));
            $('#sacon_cones1').val($(this).data('cones1'));
            $('#sacon_kg2').val($(this).data('kg2'));
            $('#sacon_pakan').val($(this).data('pakan'));
            $('#sacon_ball2').val($(this).data('ball2'));
            $('#sacon_cones2').val($(this).data('cones2'));
            $('#sacon_sisir').val($(this).data('sisir'));
            $('#sacon_te').val($(this).data('te'));
            $('#sacon_w').val($(this).data('w'));
            $('#sacon_p').val($(this).data('p'));
            $('#sacon_susut').val($(this).data('susut'));
            $('#sacon_actual').val($(this).data('actual'));
            $('#sacon_id').val($(this).data('id'));
            $('#sacon_koreksi').val($(this).data('koreksi'));
            $('#sacon_form_modal').attr('action', '/sacon/' + $(this).data('id'));
        });

        $(document).on('click', '#btnprint', function() {
            // alert('asd');   
            $('#idbarcode').val($(this).data('id'));
            document.getElementById("printbarcode").submit();

            var delayInMilliseconds = 5000; //1 second

            setTimeout(function() {
                $('#sacon-table').DataTable().ajax.reload();
            }, delayInMilliseconds);
        });

        $(document).on('click', '#delete', function() {
            $('#form_delete').attr('action', '/sacon/' + $(this).data('id'));
        });

    </script>

@section('content')
    <div class="col-md-12 col-sm-12 pt-2">
        <!-- general form elements disabled -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-white">Data Sacon</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if ($errors->any())
                    <div class="row">
                        <div class="alert alert-danger col-12">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="row pt-2">
                    <div class="table-responsive">
                        <table id="sacon-table" class="table table-sm table-striped table-bordered nowrap">
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
                                        LOT
                                    </th>
                                    <th>
                                        Lusi
                                    </th>
                                    <th>
                                        Ball
                                    </th>
                                    <th>
                                        KG
                                    </th>
                                    <th>
                                        Cones
                                    </th>
                                    <th>
                                        Pakan
                                    </th>
                                    <th>
                                        Ball
                                    </th>
                                    <th>
                                        KG
                                    </th>
                                    <th>
                                        Cones
                                    </th>
                                    <th>
                                        Sisir
                                    </th>
                                    <th>
                                        Te
                                    </th>
                                    <th>
                                        Warna
                                    </th>
                                    <th>
                                        Panjang
                                    </th>
                                    <th>
                                        Susut
                                    </th>
                                    <th>
                                        Actual
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
                                    <th>
                                        Action
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
                                        LOT
                                    </th>
                                    <th>
                                        Lusi
                                    </th>
                                    <th>
                                        Ball
                                    </th>
                                    <th>
                                        KG
                                    </th>
                                    <th>
                                        Cones
                                    </th>
                                    <th>
                                        Pakan
                                    </th>
                                    <th>
                                        Ball
                                    </th>
                                    <th>
                                        KG
                                    </th>
                                    <th>
                                        Cones
                                    </th>
                                    <th>
                                        Sisir
                                    </th>
                                    <th>
                                        Te
                                    </th>
                                    <th>
                                        Warna
                                    </th>
                                    <th>
                                        Panjang
                                    </th>
                                    <th>
                                        Susut
                                    </th>
                                    <th>
                                        Actual
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
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div id="modaledit" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalheader">Edit Sacon</h4>
                </div>
                <div class="modal-body">
                    <form id="sacon_form_modal" method="POST" action="" role="form">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" id="sacon_id" name="sacon_id">
                        <input type="hidden" id="sacon_koreksi" name="sacon_koreksi">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>KP</label>
                                    <input type="text" id="sacon_kp" name="sacon_kp" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_kp') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>ITEM</label>
                                    <input type="text" id="sacon_item" name="sacon_item" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_item') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>LOT</label>
                                    <input type="text" id="sacon_lot" name="sacon_lot" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_lot') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>LUSI</label>
                                    <input type="text" id="sacon_lusi" name="sacon_lusi" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_lusi') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>BALL</label>
                                    <input type="text" id="sacon_ball1" name="sacon_ball1" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_ball1') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>KG</label>
                                    <input type="text" id="sacon_kg1" name="sacon_kg1" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_kg1') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>CONES</label>
                                    <input type="text" id="sacon_cones1" name="sacon_cones1" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_cones1') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>PAKAN</label>
                                    <input type="text" id="sacon_pakan" name="sacon_pakan" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_pakan') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>BALL</label>
                                    <input type="text" id="sacon_ball2" name="sacon_ball2" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_ball2') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>KG</label>
                                    <input type="text" id="sacon_kg2" name="sacon_kg2" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_kg2') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>CONES</label>
                                    <input type="text" id="sacon_cones2" name="sacon_cones2" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_cones2') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>SISIR</label>
                                    <input type="text" id="sacon_sisir" name="sacon_sisir" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_sisir') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>TE</label>
                                    <input type="text" id="sacon_te" name="sacon_te" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_te') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>WARNA</label>
                                    <input type="text" id="sacon_w" name="sacon_w" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_w') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Panjang</label>
                                    <input type="text" id="sacon_p" name="sacon_p" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sacon_p') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>SUSUT</label>
                                    <input type="text" id="sacon_susut" name="sacon_susut" class="form-control"
                                        onkeyup="rumus_actual()" style="text-transform: uppercase"
                                        value="{{ old('sacon_susut') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Actual</label>
                                    <input type="text" id="sacon_actual" name="sacon_actual" onkeyup="rumus_actual()"
                                        class="form-control" style="text-transform: uppercase"
                                        value="{{ old('sacon_actual') }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" id="sacon_keterangan" name="sacon_keterangan" class="form-control"
                                        placeholder="Keterangan">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">SUBMIT</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="deletemodal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="form_delete">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" id="keterangan" name="keterangan" class="form-control"
                                    placeholder="isi keterangan">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary text-white">Hapus</button>&nbsp;
                            <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>

    <form method="POST" id="printbarcode" action="/operator2/barcode/sacon" target="_blank">
        {{ csrf_field() }}
        <input type="hidden" name="idbarcode" id="idbarcode">
    </form>

    <script src="{{ asset('/../plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/../plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $('#sacon_form_modal').validate({
            rules: {
                sacon_lot: {
                    required: true,
                },
                sacon_kp: {
                    required: true,
                },
                sacon_item: {
                    required: true,
                },
                sacon_lusi: {
                    required: true,
                },
                sacon_ball1: {
                    required: true,
                },
                sacon_kg1: {
                    required: true,
                },
                sacon_cones1: {
                    required: true,
                },
                sacon_pakan: {
                    required: true,
                },
                sacon_ball2: {
                    required: true,
                },
                sacon_kg2: {
                    required: true,
                },
                sacon_cones2: {
                    required: true,
                },
                sacon_sisir: {
                    required: true,
                },
                sacon_te: {
                    required: true,
                },
                sacon_w: {
                    required: true,
                },
                sacon_p: {
                    required: true,
                },
                sacon_susut: {
                    required: true,
                },
                sacon_actual: {
                    required: true,
                },
                sacon_keterangan: {
                    required: true,
                }
            },
            messages: {
                sacon_lot: {
                    required: ""
                },
                sacon_kp: {
                    required: ""
                },
                sacon_item: {
                    required: ""
                },
                sacon_lusi: {
                    required: ""
                },
                sacon_ball1: {
                    required: ""
                },
                sacon_kg1: {
                    required: ""
                },
                sacon_cones1: {
                    required: ""
                },
                sacon_pakan: {
                    required: ""
                },
                sacon_ball2: {
                    required: ""
                },
                sacon_kg2: {
                    required: ""
                },
                sacon_cones2: {
                    required: ""
                },
                sacon_sisir: {
                    required: ""
                },
                sacon_te: {
                    required: ""
                },
                sacon_w: {
                    required: ""
                },
                sacon_p: {
                    required: ""
                },
                sacon_susut: {
                    required: ""
                },
                sacon_actual: {
                    required: ""
                },
                sacon_keterangan: {
                    required: ""
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#form_delete').validate({
            rules: {
                keterangan: {
                    required: true,
                }
            },
            messages: {
                keterangan: {
                    required: ""
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });


        function rumus_actual() {
            let panjang = document.getElementById('sacon_p').value;
            let susut = document.getElementById('sacon_susut').value;
            let actual = 0;

            if (panjang == '') panjang = 0;
            if (susut == '') susut = 0;

            // actual = (panjang * susut) * (18/100); 
            actual = panjang - (panjang * susut);

            document.getElementById('sacon_actual').value = actual.toFixed(2);
        }

    </script>

@endsection
