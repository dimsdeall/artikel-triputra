@extends('layouts.operator2.operator2')
@section('title', 'Operator2 | Greige')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          table();
        });

        $(document).on('click', '#editmodal', function() {
            $('#no_mc').val($(this).data('no_mc'));
            $('#b').val($(this).data('b'));
            $('#p').val($(this).data('p'));
            $('#shift').val($(this).data('shift'));
            $('#sn').val($(this).data('sn'));
            $('#potongan').val($(this).data('potongan'));
            $('#grade').val($(this).data('grade'));
            $('#opr').val($(this).data('opr'));
            $('#mc_idg').val($(this).data('mc_idg'));

            $('#sacon_id').val($(this).data('idsacon'));
            $('#greige_form_modal').attr('action', '/greige/' + $(this).data('id'));

            ajaxpitem($(this).data('idsacon'), $(this).data('idweaving'), $(this).data('potongan'))
        });

        $(document).on('click', '#btnprint', function() {
            // alert('asd');   
            $('#idbarcode').val($(this).data('id'));
            document.getElementById("printbarcode").submit();

            var delayInMilliseconds = 5000; //5 second

            setTimeout(function() {
                $('#greige-table').DataTable().ajax.reload();
            }, delayInMilliseconds);
        });

        $(document).on('click', '#delete', function() {
            $('#form_delete').attr('action', '/greige/' + $(this).data('id'));
        });

    </script>

@section('content')
    <div class="col-md-12 col-sm-12 pt-2">
        <!-- general form elements disabled -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-white">Data greige</h3>
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
                        <table id="greige-table" class="table table-sm table-striped table-bordered nowrap">
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
                    <h4 class="modal-title" id="modalheader">Edit greige</h4>
                </div>
                <div class="modal-body">
                    <form id="greige_form_modal" method="POST" action="" role="form">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" id="sacon_id" name="sacon_id">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>P Item</label>
                                    <select type="text" id="pitem" name="pitem" class="form-control" onchange="ajaxpotong()"
                                        style="text-transform: uppercase">

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Potongan</label>
                                    <select type="number" id="potong" name="potong" class="form-control"
                                        onchange="snchange()" style="text-transform: uppercase">

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>SN</label>
                                    <input type="text" id="sn" name="sn" class="form-control"
                                        style="text-transform: uppercase" readonly required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Shift</label>
                                    <input type="text" id="shift" name="shift" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('shift') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>OPR</label>
                                    <input type="text" id="opr" name="opr" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('opr') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Grade</label>
                                    <input type="txt" id="grade" name="grade" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('grade') }}" required>
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

    <form method="POST" id="printbarcode" action="/operator2/barcode/greige" target="_blank">
        {{ csrf_field() }}
        <input type="hidden" name="idbarcode" id="idbarcode">
    </form>

    <form action="/greige/export/excel" id="form_export" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" id="export_take" name="export_take">
      <input type="hidden" id="export_kp" name="export_kp">
      <input type="hidden" id="export_tgl1" name="export_tgl1">
      <input type="hidden" id="export_tgl2" name="export_tgl2">
    </form>

    <script src="{{ asset('/../plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/../plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $('#greige_form_modal').validate({
            rules: {
                shift: {
                    required: true,
                },
                potong: {
                    required: true,
                },
                p: {
                    required: true,
                },
                b: {
                    required: true,
                },
                opr: {
                    required: true,
                },
                grade: {
                    required: true,
                },
                keterangan_edit: {
                    required: true,
                }
            },
            messages: {
                shift: {
                    required: ""
                },
                potong: {
                    required: ""
                },
                p: {
                    required: ""
                },
                b: {
                    required: ""
                },
                opr: {
                    required: "",
                },
                grade: {
                    required: "",
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

        function ajaxpitem(idsacon, idweaving, potong) {
            $.ajax({
                type: 'POST',
                url: '/operator2/pitem/data',
                data: {
                    _token: "{{ csrf_token() }}",
                    sacon: idsacon,
                    weaving: idweaving,
                    potongan: potong
                },
                success: function(data) {
                    let res = data.split("|");
                    document.getElementById('pitem').innerHTML = res[0];
                    document.getElementById('potong').innerHTML = res[1];
                    document.getElementById('sn').value = res[2];
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });

        }

        function ajaxpotong() {
            let item = document.getElementById('pitem').value;
            let idsacon = document.getElementById('sacon_id').value;
            $.ajax({
                type: 'POST',
                url: '/operator1/potong/data',
                data: {
                    _token: "{{ csrf_token() }}",
                    pitem: item,
                    sacon: idsacon
                },
                success: function(data) {
                    let res = data.split('|');
                    document.getElementById('potong').innerHTML = res[0];
                    document.getElementById('sn').value = res[1];
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });

        }

        function snchange() {
            let potong = document.getElementById('potong').value;
            $.ajax({
                type: 'POST',
                url: '/operator1/sn/data',
                data: {
                    _token: "{{ csrf_token() }}",
                    potongan: potong
                },
                success: function(data) {
                    document.getElementById('sn').value = data;
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });
        }

        function table() {
          $('#greige-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/greige/operator2/getdata',
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
