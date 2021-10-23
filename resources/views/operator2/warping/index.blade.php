@extends('layouts.operator2.operator2')
@section('title', 'Operator2 | Warping')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            table();
        });

        $(document).on('click', '#editmodal', function() {
            $('#lot').val($(this).data('lot'));
            $('#nb').val($(this).data('nb'));
            $('#p').val($(this).data('p'));
            $('#b').val($(this).data('b'));
            $('#te').val($(this).data('te'));
            $('#print').val($(this).data('print'));
            $('#sacon_id').val($(this).data('idsacon'));
            $('#warping_form_modal').attr('action', '/warping/' + $(this).data('id'));
        });

        $(document).on('click', '#btnprint', function() {
            //   alert('asd');   
            $('#idbarcode').val($(this).data('id'));
            document.getElementById("printbarcode").submit();

            var delayInMilliseconds = 5000; //1 second

            setTimeout(function() {
                $('#warping-table').DataTable().ajax.reload();
            }, delayInMilliseconds);

        });

        $(document).on('click', '#delete', function() {
            $('#form_delete').attr('action', '/warping/' + $(this).data('id'));
        });

    </script>

@section('content')
    <div class="col-md-12 col-sm-12 pt-2">
        <!-- general form elements disabled -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-white">Data Warping</h3>
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

                <form id="form-sortir" class="border p-1" method="dialog">
                    {{ csrf_field() }}
                    <div class="row justify-content-md-center">
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>Total Data</label>
                                <input type="number" id="number" name="number" class="form-control" value="{{ $number }}"
                                    min="1" max="300" style="text-transform: uppercase" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>KP</label>
                                <input type="text" id="kp" name="kp" class="form-control" value="{{ $kp }}" list="kp_list"
                                    autocomplete="off" style="text-transform: uppercase" />
                                <datalist id="kp_list">
                                    @foreach ($sacon as $item)
                                        <option value="{{ $item->kp }}"> {{ $item->kp }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" id="tgl1" name="tgl1" class="form-control" value="{{ $tgl1 }}"
                                    style="text-transform: uppercase" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="date" id="tgl2" name="tgl2" class="form-control" value="{{ $tgl2 }}"
                                    style="text-transform: uppercase" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="row pt-4 mt-2">
                                <button type="button" name="btnsbmt"
                                    onclick="table();"
                                    class="btn btn-primary"><i class="fa fa-filter">&nbsp;</i> FILTER </button>
                                <button type="button" name="btnsbmt" onclick="export_excel();"
                                    class="btn btn-success ml-3"><i class="fa fa-file-excel">&nbsp;</i> EXPORT </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row pt-2">
                    <div class="table-responsive">
                        <table id="warping-table" class="table table-sm table-striped table-bordered nowrap">
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
                                        No Beam
                                    </th>
                                    <th>
                                        TE
                                    </th>
                                    <th>
                                        Panjang
                                    </th>
                                    <th>
                                        Berat
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
                                        No Beam
                                    </th>
                                    <th>
                                        TE
                                    </th>
                                    <th>
                                        Panjang
                                    </th>
                                    <th>
                                        Berat
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
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalheader">Edit Warping</h4>
                </div>
                <div class="modal-body">
                    <form id="warping_form_modal" method="POST" action="" role="form">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="print" name="print">
                        <input type="hidden" id="sacon_id" name="sacon_id">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>LOT</label>
                                    <input type="text" id="lot" name="lot" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('lot') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>No Beam</label>
                                    <input type="number" id="nb" name="nb" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('nb') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>TE</label>
                                    <input type="text" id="te" name="te" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('te') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Panjang</label>
                                    <input type="number" id="p" name="p" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('p') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input type="number" id="b" name="b" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('b') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" id="warping_keterangan" name="warping_keterangan"
                                        class="form-control" placeholder="Keterangan">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">SUBMIT</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

    <form method="POST" id="printbarcode" action="/operator2/barcode/warping" target="_blank">
        {{ csrf_field() }}
        <input type="hidden" name="idbarcode" id="idbarcode">
    </form>

    <form action="/warping/export/excel" id="form_export" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" id="export_take" name="export_take">
      <input type="hidden" id="export_kp" name="export_kp">
      <input type="hidden" id="export_tgl1" name="export_tgl1">
      <input type="hidden" id="export_tgl2" name="export_tgl2">
    </form>

    <script src="{{ asset('/../plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/../plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $('#warping_form_modal').validate({
            rules: {
                lot: {
                    required: true,
                },
                nb: {
                    required: true,
                },
                te: {
                    required: true,
                },
                p: {
                    required: true,
                },
                b: {
                    required: true,
                },
                warping_keterangan: {
                    required: true,
                }
            },
            messages: {
                lot: {
                    required: "",
                },
                nb: {
                    required: ""
                },
                te: {
                    required: "",
                },
                p: {
                    required: ""
                },
                b: {
                    required: ""
                },
                warping_keterangan: {
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

        function table() {
            $('#warping-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/warping/operator2/getdata',
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        take: $('#number').val(),
                        kp: $('#kp').val(),
                        tgl1: $('#tgl1').val(),
                        tgl2: $('#tgl2').val(),
                    },
                },
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
                        data: 'nb',
                        name: 'nb'
                    },
                    {
                        data: 'te',
                        name: 'te'
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
        }

        function export_excel(){
          $('#export_take').val($('#number').val());
          $('#export_kp').val($('#kp').val());
          $('#export_tgl1').val($('#tgl1').val());
          $('#export_tgl2').val($('#tgl2').val());

          $('#form_export').submit();
        }
    </script>
@endsection
