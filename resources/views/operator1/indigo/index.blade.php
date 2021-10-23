@extends('layouts.operator1.operator1')
@section('title', 'Operator1 | Indigo')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#indigo-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        method : 'GET',
        ajax: '{{URL::to("/indigo/operator1/getdata/".$sacon->id)}}',
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'kp', name: 'kp'},
        {data: 'item', name: 'item'},
        {data: 'lot', name: 'lot'},
        {data: 'mc_idg', name: 'mc_idg'},
        {data: 'nb', name: 'nb'},
        {data: 'te', name: 'te'},
        {data: 'w', name: 'w'},
        {data: 'p', name: 'p'},
        {data: 'b', name: 'b'},
        {data: 'user_id', name: 'user_id'},
        {data: 'print', name: 'print'},
        {data: 'created_at', name: 'created_at'},
        ]
    }); 
} );

$(document).ready(function() {
    $('#warping-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        bFilter: false,
        method : 'GET',
        ajax: '{{URL::to("/warping/operator1/getdata/".$sacon->id)}}',
        columns: [
        {data: 'status', name: 'status', orderable: false, searchable: false},
        {data: 'nb', name: 'nb'},
        {data: 'lot', name: 'lot'},
        {data: 'te', name: 'te'},
        {data: 'p', name: 'p'},
        {data: 'b', name: 'b'},
        {data: 'created_at', name: 'created_at'},
        ],
        columnDefs: [
          {
              targets: 0,
              className: 'text-center',
          }
        ]
    }); 
} );
</script>

@section('content')
<div class="col-md-12 col-sm-12 pt-2">
  <div class="card card-info card-tabs">
    <div class="card-header p-0 pt-1">
      <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
        <li class="nav-item col-6">
          <a class="nav-link active" id="custom-tabs-one-warping-tab" data-toggle="pill" href="#custom-tabs-one-warping" role="tab" aria-controls="custom-tabs-one-warping" aria-selected="true">Warping</a>
        </li>
        <li class="nav-item col-6">
          <a class="nav-link" id="custom-tabs-one-indigo-tab" data-toggle="pill" href="#custom-tabs-one-indigo" role="tab" aria-controls="custom-tabs-one-indigo" aria-selected="false">Indigo</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content" id="custom-tabs-one-tabContent">
        <div class="tab-pane fade show active" id="custom-tabs-one-warping" role="tabpanel" aria-labelledby="custom-tabs-one-warping-tab">
          <div class="row">
            <div class="col-sm-2 col-2">
              <label>KP</label>
            </div>
            <div class="col-sm-10 col-10">
              <label>{{ ': '.$sacon->kp }}</label>
            </div>
            <div class="col-sm-2 col-2">
              <label>Item</label>
            </div>
            <div class="col-sm-10 col-10">
              <label>{{ ': '.$sacon->item }}</label>
            </div>
            <div class="col-sm-6 col-8">
              <input type="text" id="barcode" name="barcode" class="form-control" style="text-transform: uppercase" placeholder="Scan Barcode">
            </div>
            <div class="col-sm-4 col-4" >
              <button class="btn btn-primary btn-lg" onclick="checkbarcode()"><i class="fa fa-search"></i></button>
            </div>
            <div class="table-responsive">
              <table id="warping-table" class="table table-sm table-striped table-bordered nowrap">
                  <thead>
                      <tr>
                        <th>
                            Status
                        </th>
                        <th>
                          No Beam
                        </th>
                        <th>
                            LOT
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
                          No Beam
                        </th>
                        <th>
                            LOT
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
                            Tanggal
                        </th>
                      </tr>
                  </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="custom-tabs-one-indigo" role="tabpanel" aria-labelledby="custom-tabs-one-indigo-tab">
          <div class="row">
            {{-- <button class="btn btn-sm btn-primary mb-2" onclick="checkwarping();" id="btnwarping">Buat Indigo</button> --}}
            <div class="table-responsive">
              <table id="indigo-table" class="table table-sm table-striped table-bordered nowrap" style="width: 100%">
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

<form action="{{ route('indigo.create') }}" id="form_indigo" method="GET">
  <input type="hidden" id="kp" name="kp" value="{{ $_GET['kp'] }}">
</form>

<div class="modal fade bd-example-modal-sm" id="blank_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Result</h4>
      </div>
      <div class="modal-body">
        Data tidak di temukan . . .
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss='modal' onclick="$('#barcode').val('');$('#barcode').focus();"> OK </button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#barcode').focus();

  $('.nav li').click(function() {
    $('#barcode').focus();
  });

  $('#barcode').keypress(function (e) {
    var key = e.which;
    if(key == 13)  // the enter key code
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

    if ((kp_val == '') || (id_val == null) || (id_val == '') || (status.toUpperCase() != 'WARPING')) {
      $('#blank_modal').modal('show')
      return true;
    }

    $.ajax({
        type: 'POST',
        url: '/cekbarcode/warping',
        data: {_token: "{{ csrf_token() }}", kp : kp_val, id : id_val, sacon_id : "{{ $sacon->id }}"},
        success: function (data) {       
          const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000
          });

          let res = data.split('|');

          if (res[0] == 'ok') {
            Toast.fire({
              type: 'success',
              title: 'verification succeess!'
            })      
            $('#warping-table').DataTable().ajax.reload();      
          }else if (res[0] == 'move') {
            window.open(res[1],'_self');
          } else{
            Toast.fire({
              type: 'error',
              title: 'verification failed!'
            })
          }
          $('#barcode').val('');
        },
        error: function (xhr) {
          //Do Something to handle error
          alert(xhr.responseText);
        }
    });
  };

  function checkwarping() {
    let sacon_id = "{{ $sacon->id }}";
    $.ajax({
        type: 'POST',
        url: '/warping/status/check',
        data: {_token: "{{ csrf_token() }}", sacon : sacon_id},
        success: function (data) {     
          const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000
          });

          if (data == 'ok') {
            $('#form_indigo').submit();
          }else{
            Toast.fire({
              type: 'warning',
              title: 'Data belum terverifikasi semua!'
            })
          }
          $('#barcode').val('');
        },
        error: function (xhr) {
          //Do Something to handle error
          alert(xhr.responseText);
        }
    });
  };
</script>
@endsection