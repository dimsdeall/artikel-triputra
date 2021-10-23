@extends('layouts.operator1.operator1')
@section('title', 'Operator1 | Warping')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#warping-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        method : 'GET',
        ajax: '{{URL::to("/warping/operator1/getdata/".$sacon->id)}}',
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'kp', name: 'kp'},
        {data: 'item', name: 'item'},
        {data: 'lot', name: 'lot'},
        {data: 'nb', name: 'nb'},
        {data: 'te', name: 'te'},
        {data: 'p', name: 'p'},
        {data: 'b', name: 'b'},
        {data: 'user_id', name: 'user_id'},
        {data: 'print', name: 'print'},
        {data: 'created_at', name: 'created_at'},
        ]
    }); 
} );
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
        <div class="row">
        <form action="{{ route('warping.create') }}" method="GET">
            <input type="hidden" id="kp" name="kp" id="barcodeitem" value="{{ $_GET['kp'] }}">
            <button class="btn btn-sm btn-success" id="btnwarping">Buat Warping</button>
        </form>
        </div>
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

@endsection