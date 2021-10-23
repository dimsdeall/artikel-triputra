@extends('layouts.operator2.operator2')
@section('title', 'Operator1 | Weaving')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          table();
        });

        $(document).on('click', '#editmodal', function() {
            $('#pitem').val($(this).data('pitem'));
            $('#lot').val($(this).data('lot'));
            $('#mc').val($(this).data('mc'));
            $('#pakan').val($(this).data('pakan'));
            $('#pick').val($(this).data('pick'));
            $('#sisir').val($(this).data('sisir'));
            $('#anyaman').val($(this).data('anyaman'));
            $('#potongan').val($(this).data('potongan'));
            $('#p').val($(this).data('p'));
            $('#b').val($(this).data('b'));
            $('#shift').val($(this).data('shift'));
            $('#sn').val($(this).data('sn'));
            $('#opr').val($(this).data('opr'));
            $('#id').val($(this).data('idsacon'));
            $('#edit_form').attr('action', '/weaving/' + $(this).data('id'));

            nb($(this).data('idsacon'), $(this).data('idindigo'), $(this).data('opr'));
        });

        $(document).on('click', '#btnprint', function() {
            //   alert('asd');   
            $('#idbarcode').val($(this).data('id'));
            document.getElementById("printbarcode").submit();

            var delayInMilliseconds = 5000; //1 second

            setTimeout(function() {
                $('#weaving-table').DataTable().ajax.reload();
            }, delayInMilliseconds);
        });

        $(document).on('click', '#delete', function() {
            $('#form_delete').attr('action', '/weaving/' + $(this).data('id'));
        });

    </script>

@section('content')
    <div class="col-md-12 col-sm-12 pt-2">
        <!-- general form elements disabled -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-white">Data Weaving</h3>
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
                                <button type="button" name="btnsbmt" onclick="table();" class="btn btn-primary"><i
                                        class="fa fa-filter">&nbsp;</i> FILTER </button>
                                <button type="button" name="btnsbmt" onclick="export_excel();"
                                    class="btn btn-success ml-3"><i class="fa fa-file-excel">&nbsp;</i> EXPORT </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row pt-2">
                    <div class="table-responsive">
                        <table id="weaving-table" class="table table-sm table-striped table-bordered nowrap">
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
                    <h4 class="modal-title" id="modalheader">Edit Weaving</h4>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="POST" action="" role="form">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" id="id" name="id">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>P Item</label>
                                    <input type="text" id="pitem" name="pitem" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('pitem') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>LOT</label>
                                    <input type="text" id="lot" name="lot" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('lot') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>MC</label>
                                    <input type="text" id="mc" name="mc" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('mc') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>No Beam</label>
                                    <select type="number" id="nb" name="nb" class="form-control"
                                        style="text-transform: uppercase">

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Pakan</label>
                                    <input type="text" id="pakan" name="pakan" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('pakan') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3 d-none">
                                <div class="form-group">
                                    <label>Pick</label>
                                    <input type="text" id="pick" name="pick" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('pick') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3 d-none">
                                <div class="form-group">
                                    <label>Sisir</label>
                                    <input type="text" id="sisir" name="sisir" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sisir') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3 d-none">
                                <div class="form-group">
                                    <label>Anyaman</label>
                                    <input type="text" id="anyaman" name="anyaman" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('anyaman') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Potongan</label>
                                    <input type="text" id="potongan" name="potongan" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('potongan') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Panjang</label>
                                    <input type="number" id="p" name="p" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('p') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input type="number" id="b" name="b" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('b') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>OPR</label>
                                    <input type="text" id="opr" name="opr" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('opr') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Shift</label>
                                    <input type="text" id="shift" name="shift" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('shift') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>SN</label>
                                    <input type="text" id="sn" name="sn" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sn') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" id="keterangan_edit" name="keterangan_edit" class="form-control"
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

    <form method="POST" id="printbarcode" action="/operator2/barcode/weaving" target="_blank">
        {{ csrf_field() }}
        <input type="hidden" name="idbarcode" id="idbarcode">

    </form>

    <form action="/weaving/export/excel" id="form_export" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" id="export_take" name="export_take">
      <input type="hidden" id="export_kp" name="export_kp">
      <input type="hidden" id="export_tgl1" name="export_tgl1">
      <input type="hidden" id="export_tgl2" name="export_tgl2">
    </form>

    <script src="{{ asset('/../plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/../plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script>
        $('#edit_form').validate({
            rules: {
                lot: {
                    required: true,
                },
                mc: {
                    required: true,
                },
                nb: {
                    required: true,
                },
                pakan: {
                    required: true,
                },
                pick: {
                    required: true,
                },
                sisir: {
                    required: true,
                },
                anyaman: {
                    required: true,
                },
                potongan: {
                    required: true,
                },
                p: {
                    required: true,
                },
                b: {
                    required: true,
                },
                shift: {
                    required: true,
                },
                opr: {
                    required: true,
                },
                sn: {
                    required: true,
                },
                keterangan_edit: {
                    required: true,
                }
            },
            messages: {
                lot: {
                    required: ""
                },
                mc: {
                    required: ""
                },
                nb: {
                    required: ""
                },
                pakan: {
                    required: ""
                },
                pick: {
                    required: ""
                },
                sisir: {
                    required: ""
                },
                anyaman: {
                    required: ""
                },
                potongan: {
                    required: ""
                },
                p: {
                    required: ""
                },
                b: {
                    required: ""
                },
                shift: {
                    required: ""
                },
                opr: {
                    required: ""
                },
                sn: {
                    required: ""
                },
                keterangan_edit: {
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

        function nb(idsacon, idindigo, idopr) {
            $.ajax({
                type: 'POST',
                url: '/weaving/operator2/getnb',
                data: {
                    _token: "{{ csrf_token() }}",
                    sacon: idsacon,
                    indigo: idindigo,
                    opr: idopr
                },
                success: function(data) {
                    document.getElementById('nb').innerHTML = data;
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });

        }

        function table() {
          $('#weaving-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/weaving/operator2/getdata',
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
