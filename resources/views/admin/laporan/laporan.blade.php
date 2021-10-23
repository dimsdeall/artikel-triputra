@extends('layouts.admin.admin')
@section('title', 'Admin | Laporan')

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            $('#indigo-table').DataTable();
        });

    </script>

@section('content')
    <div class="col-md-12 col-sm-12 pt-2">
        <!-- general form elements disabled -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-white">Laporan</h3>
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
                <form action="/laporanadmin/sortir" id="form-sortir" class="border p-1" method="GET">
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
                                <button type="submit" name="btnsbmt" value="0" class="btn btn-primary"><i
                                        class="fa fa-filter">&nbsp;</i> FILTER </button>
                                <button type="submit" name="btnsbmt" value="1" class="btn btn-success ml-3"><i
                                        class="fa fa-file-excel">&nbsp;</i> EXPORT </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row pt-2">
                    <div class="table-responsive">
                        <table id="indigo-table" class="table table-sm table-striped table-bordered nowrap">
                            <thead style="font-weight: bold;">
                                <tr>
                                    <th rowspan="2" style="vertical-align : middle;text-align:center;">
                                        No
                                    </th>
                                    <th colspan="19" align="center">
                                        <center>Sacon</center>
                                    </th>
                                    <th colspan="7" align="center">
                                        <center>Warping</center>
                                    </th>
                                    <th colspan="9" align="center">
                                        <center>Indigo</center>
                                    </th>
                                    <th colspan="16" align="center">
                                        <center>Weaving</center>
                                    </th>
                                    <th colspan="9" align="center">
                                        <center>Greige</center>
                                    </th>
                                    <th colspan="17" align="center">
                                        <center>Finish</center>
                                    </th>
                                </tr>
                                <tr>
                                    {{-- SACON --}}
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
                                        ball
                                    </th>
                                    <th>
                                        KG
                                    </th>
                                    <th>
                                        cones
                                    </th>
                                    <th>
                                        Pakan
                                    </th>
                                    <th>
                                        ball
                                    </th>
                                    <th>
                                        KG
                                    </th>
                                    <th>
                                        cones
                                    </th>
                                    <th>
                                        Sisir
                                    </th>
                                    <th>
                                        TE
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
                                        Tanggal
                                    </th>
                                    {{-- WARPING --}}
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
                                        Tanggal
                                    </th>
                                    {{-- INDIGO --}}
                                    <th>
                                        LOT
                                    </th>
                                    <th>
                                        MC IDG
                                    </th>
                                    <th>
                                        No Beam
                                    </th>
                                    <th>
                                        TE
                                    </th>
                                    <th>
                                        Warna
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
                                        Tanggal
                                    </th>
                                    {{-- WEAVING --}}
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
                                        OPR
                                    </th>
                                    <th>
                                        Shift
                                    </th>
                                    <th>
                                        SN
                                    </th>
                                    <th>
                                        Author
                                    </th>
                                    <th>
                                        Tanggal
                                    </th>
                                    {{-- GREIGE --}}
                                    <th>
                                        Shift
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
                                        Potongan
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
                                        Tanggal
                                    </th>
                                    {{-- FINISH --}}
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
                                        Susut Lusi
                                    </th>
                                    <th>
                                        Inisial
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
                                        Tanggal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($datas as $data)
                                    @php
                                    $now = time(); // or your date as well
                                    $date = strtotime(substr($data->created_at_sacon, 0,10));
                                    $datediff = $now - $date;

                                    $diff = round($datediff / (60 * 60 * 24));
                                    @endphp

                                    @if ($data->k_finish != '' or $data->k_finish != null)
                                        <tr style="background-color: rgb(62, 167, 62); ">

                                        @elseif ($diff > 30)
                                        <tr style="background-color: rgb(181, 55, 55)">
                                        @else
                                        <tr style="background-color: rgb(248, 248, 93)">
                                    @endif
                                    <td>
                                        {{ $i }}
                                        @php
                                        $i++;
                                        @endphp
                                    </td>
                                    {{-- SACON --}}
                                    <td>
                                        {{ $data->kp }}
                                    </td>
                                    <td>
                                        {{ $data->item }}
                                    </td>
                                    <td>
                                        {{ $data->lot }}
                                    </td>
                                    <td>
                                        {{ $data->lusi }}
                                    </td>
                                    <td>
                                        {{ $data->ball1 }}
                                    </td>
                                    <td>
                                        {{ $data->kg1 }}
                                    </td>
                                    <td>
                                        {{ $data->cones1 }}
                                    </td>
                                    <td>
                                        {{ $data->pakan }}
                                    </td>
                                    <td>
                                        {{ $data->ball2 }}
                                    </td>
                                    <td>
                                        {{ $data->kg2 }}
                                    </td>
                                    <td>
                                        {{ $data->cones2 }}
                                    </td>
                                    <td>
                                        {{ $data->sisir }}
                                    </td>
                                    <td>
                                        {{ $data->te }}
                                    </td>
                                    <td>
                                        {{ $data->w }}
                                    </td>
                                    <td>
                                        {{ $data->p }}
                                    </td>
                                    <td>
                                        {{ $data->susut }}
                                    </td>
                                    <td>
                                        {{ $data->actual }}
                                    </td>
                                    <td>
                                        {{ $data->user_sacon }}
                                    </td>
                                    <td>
                                        {{ $data->created_at_sacon }}
                                    </td>
                                    {{-- WARPING --}}
                                    <td>
                                        {{ $data->lot_warping }}
                                    </td>
                                    <td>
                                        {{ $data->nb_warping }}
                                    </td>
                                    <td>
                                        {{ $data->te_warping }}
                                    </td>
                                    <td>
                                        {{ $data->p_warping }}
                                    </td>
                                    <td>
                                        {{ $data->b_warping }}
                                    </td>
                                    <td>
                                        {{ $data->user_warping }}
                                    </td>
                                    <td>
                                        {{ $data->created_at_warping }}
                                    </td>
                                    {{-- INDIGO --}}
                                    <td>
                                        {{ $data->lot_indigo }}
                                    </td>
                                    <td>
                                        {{ $data->mc_idg_indigo }}
                                    </td>
                                    <td>
                                        {{ $data->nb_indigo }}
                                    </td>
                                    <td>
                                        {{ $data->te_indigo }}
                                    </td>
                                    <td>
                                        {{ $data->w_indigo }}
                                    </td>
                                    <td>
                                        {{ $data->p_indigo }}
                                    </td>
                                    <td>
                                        {{ $data->b_indigo }}
                                    </td>
                                    <td>
                                        {{ $data->user_indigo }}
                                    </td>
                                    <td>
                                        {{ $data->created_at_indigo }}
                                    </td>
                                    {{-- WEAVING --}}
                                    <td>
                                        {{ $data->pitem_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->lot_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->mc_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->nb_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->pakan_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->pick_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->sisir_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->anyaman_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->potongan_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->p_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->b_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->opr_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->shift_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->sn_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->user_weaving }}
                                    </td>
                                    <td>
                                        {{ $data->created_at_weaving }}
                                    </td>
                                    {{-- GREIGE --}}
                                    <td>
                                        {{ $data->shift_greige }}
                                    </td>
                                    <td>
                                        {{ $data->p_greige }}
                                    </td>
                                    <td>
                                        {{ $data->b_greige }}
                                    </td>
                                    <td>
                                        {{ $data->sn_greige }}
                                    </td>
                                    <td>
                                        {{ $data->potongan_greige }}
                                    </td>
                                    <td>
                                        {{ $data->grade_greige }}
                                    </td>
                                    <td>
                                        {{ $data->opr_greige }}
                                    </td>
                                    <td>
                                        {{ $data->user_greige }}
                                    </td>
                                    <td>
                                        {{ $data->created_at_greige }}
                                    </td>
                                    {{-- FINISH --}}
                                    <td>
                                        {{ $data->title_finish }}
                                    </td>
                                    <td>
                                        {{ $data->potong_finish }}
                                    </td>
                                    <td>
                                        {{ $data->lot_finish }}
                                    </td>
                                    <td>
                                        {{ $data->grade_finish }}
                                    </td>
                                    <td>
                                        {{ $data->point_finish }}
                                    </td>
                                    <td>
                                        {{ $data->yds_finish }}
                                    </td>
                                    <td>
                                        {{ $data->kg_finish }}
                                    </td>
                                    <td>
                                        {{ $data->lebar_finish }}
                                    </td>
                                    <td>
                                        {{ $data->sn_finish }}
                                    </td>
                                    <td>
                                        {{ $data->k3l_finish }}
                                    </td>
                                    <td>
                                        {{ $data->susutlusi_finish }}
                                    </td>
                                    <td>
                                        {{ $data->inisial_finish }}
                                    </td>
                                    <td>
                                        {{ $data->k_finish }}
                                    </td>
                                    <td>
                                        {{ $data->actual_finish }}
                                    </td>
                                    <td>
                                        {{ $data->tgl_finish }}
                                    </td>
                                    <td>
                                        {{ $data->user_finish }}
                                    </td>
                                    <td>
                                        {{ $data->created_at_finish }}
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade" id="modalkp">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih KP</h4>
                </div>
                <form action="laporan/excel" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <select name="kp" id="kp" class="form-control">
                            <option value="0">Semua</option>
                            @foreach ($sacon as $item)
                                <option value="{{ $item->id }}"> {{ $item->kp }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-danger col-6" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary col-6">OK</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
