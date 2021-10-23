@extends('layouts.operator2.operator2')
@section('title', 'Operator2 | Finish')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          table();
        });

        $(document).on('click', '#editmodal', function() {
            $('#title').val($(this).data('title'));
            $('#potong').val($(this).data('potong'));
            $('#lot').val($(this).data('lot'));
            $('#grade').val($(this).data('grade'));
            $('#point').val($(this).data('point'));
            $('#yds').val($(this).data('yds'));
            $('#kg').val($(this).data('kg'));
            $('#lebar').val($(this).data('lebar'));
            $('#sn').val($(this).data('sn'));
            $('#k3l').val($(this).data('k3l'));
            $('#inisial').val($(this).data('inisial'));
            $('#susutlusi').val($(this).data('susutlusi'));
            $('#k').val($(this).data('k'));
            $('#actual').val($(this).data('actual'));
            $('#tgl').val($(this).data('tgl'));

            $('#idsacon').val($(this).data('idsacon'));
            $('#greige_id').val($(this).data('idgreige'));
            $('#form_modal').attr('action', '/finish/' + $(this).data('id'));

            // ajaxfinishgrade($(this).data('idsacon'), $(this).data('idgreige'));
        });

        $(document).on('click', '#btnprint', function() {
            // alert('asd');   
            $('#idbarcode').val($(this).data('id'));
            document.getElementById("printbarcode").submit();

            var delayInMilliseconds = 5000; //5 second

            setTimeout(function() {
                $('#finish-table').DataTable().ajax.reload();
            }, delayInMilliseconds);
        });

        $(document).on('click', '#delete', function() {
            $('#form_delete').attr('action', '/finish/' + $(this).data('id'));
        });

    </script>

@section('content')
    <div class="col-md-12 col-sm-12 pt-2">
        <!-- general form elements disabled -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-white">Data Finish</h3>
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
                        <table id="finish-table" class="table table-sm table-striped table-bordered nowrap">
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
                    <h4 class="modal-title" id="modalheader">Edit Finish</h4>
                </div>
                <div class="modal-body">
                    <form id="form_modal" method="POST" action="" role="form">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" id="idsacon" name="idsacon">
                        <input type="hidden" id="greige_id" name="greige_id">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('title') }}" />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Potong</label>
                                    <input type="number" id="potong" name="potong" class="form-control" style="text-transform: uppercase"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>LOT</label>
                                    <input type="text" id="lot" name="lot" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('lot') }}" />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Grade</label>
                                    <input type="text" id="grade" name="grade" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('grade') }}" />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Point</label>
                                    <input type="text" id="point" name="point" class="form-control"
                                        value="{{ old('point') }}" style="text-transform: uppercase">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>YDS</label>
                                    <input type="number" id="yds" name="yds" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('yds') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>KG</label>
                                    <input type="number" id="kg" name="kg" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('kg') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Lebar</label>
                                    <input type="text" id="lebar" name="lebar" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('lebar') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>SN</label>
                                    <input type="text" id="sn" name="sn" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('sn') }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>K3L</label>
                                    <input type="text" id="k3l" name="k3l" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('k3l') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Inisial</label>
                                    <input type="text" id="inisial" name="inisial" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('inisial') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Susut Lusi</label>
                                    <input type="text" id="susutlusi" name="susutlusi" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('susutlusi') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>K</label>
                                    <input type="text" id="k" name="k" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('k') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Actual</label>
                                    <input type="text" id="actual" name="actual" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('actual') }}" readonly required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>TGL</label>
                                    <input type="date" id="tgl" name="tgl" class="form-control"
                                        style="text-transform: uppercase" value="{{ old('tgl') }}" required>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>

        </div>
    </div>

    <form method="POST" id="printbarcode" action="/operator2/barcode/finish" target="_blank">
        {{ csrf_field() }}
        <input type="hidden" name="idbarcode" id="idbarcode">
    </form>

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

    <form action="/finish/export/excel" id="form_export" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" id="export_take" name="export_take">
      <input type="hidden" id="export_kp" name="export_kp">
      <input type="hidden" id="export_tgl1" name="export_tgl1">
      <input type="hidden" id="export_tgl2" name="export_tgl2">
    </form>

    <script src="{{ asset('/../plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/../plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $('#form_modal').validate({
            rules: {
                title: {
                    required: true,
                },
                potong: {
                    required: true,
                },
                lot: {
                    required: true,
                },
                grade: {
                    required: true,
                },
                point: {
                    required: true,
                },
                yds: {
                    required: true,
                },
                kg: {
                    required: true,
                },
                lebar: {
                    required: true,
                },
                sn: {
                    required: true,
                },
                k3l: {
                    required: true,
                },
                inisial: {
                    required: true,
                },
                susutlusi: {
                    required: true,
                },
                k: {
                    required: true,
                },
                actual: {
                    required: true,
                },
                tgl: {
                    required: true,
                    date: true,
                },
                keterangan_edit: {
                    required: true,
                }
            },
            messages: {
                title: {
                    required: ""
                },
                potong: {
                    required: ""
                },
                lot: {
                    required: ""
                },
                grade: {
                    required: ""
                },
                point: {
                    required: ""
                },
                yds: {
                    required: ""
                },
                kg: {
                    required: ""
                },
                lebar: {
                    required: ""
                },
                sn: {
                    required: ""
                },
                k3l: {
                    required: ""
                },
                inisial: {
                    required: ""
                },
                susutlusi: {
                    required: ""
                },
                k: {
                    required: ""
                },
                actual: {
                    required: ""
                },
                tgl: {
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

        function ajaxfinishgrade(idsacon, idgreige) {
            $.ajax({
                type: 'POST',
                url: '/finish/operator2/grade',
                data: {
                    _token: "{{ csrf_token() }}",
                    sacon: idsacon,
                    greige: idgreige
                },
                success: function(data) {
                    // alert(data);
                    document.getElementById('potong').innerHTML = data;
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });

        }

        function ajaxfinishsn() {
            var idgrade = document.getElementById('potong').value;
            var idsacon = document.getElementById('idsacon').value;
            $.ajax({
                type: 'POST',
                url: '/operator1/finish/sn',
                data: {
                    _token: "{{ csrf_token() }}",
                    grade: idgrade,
                    sacon: idsacon
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
          $('#finish-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/finish/operator2/getdata',
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
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'potong',
                        name: 'potong'
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
