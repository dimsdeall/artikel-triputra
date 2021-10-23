@extends('layouts.admin.admin')
@section('title', 'Admin | Sacon')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#sacon-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        method : 'GET',
        ajax: '{{URL::to("/sacon/admin/getdata")}}',
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'kp', name: 'kp'},
        {data: 'item', name: 'item'},
        {data: 'lusi', name: 'lusi'},
        {data: 'pakan', name: 'pakan'},
        {data: 'sisir', name: 'sisir'},
        {data: 'te', name: 'te'},
        {data: 'w', name: 'w'},
        {data: 'j', name: 'j'},
        {data: 'user_id', name: 'user_id'},
        {data: 'print', name: 'print'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action', name: 'action',orderable: false, searchable: false }
        ]
    }); 
} );

$(document).on('click', '#editmodal', function(){   
    $('#sacon_kp').val($(this).data('kp'));
    $('#sacon_item').val($(this).data('item'));
    $('#sacon_nb1').val($(this).data('nb1'));
    $('#sacon_nb2').val($(this).data('nb2'));
    $('#sacon_sisir').val($(this).data('sisir'));
    $('#sacon_te').val($(this).data('te'));
    $('#sacon_w').val($(this).data('w'));
    $('#sacon_j').val($(this).data('j'));
    $('#sacon_id').val($(this).data('id'));
    $('#sacon_koreksi').val($(this).data('koreksi'));
    $('#sacon_form_modal').attr('action', '/sacon/'+$(this).data('id') );
});

$(document).on('click', '#btnprint', function(){
  // alert('asd');   
  $('#idbarcode').val($(this).data('id'));
  document.getElementById("printbarcode").submit();
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
        <a class="btn btn-primary" href="{{ route('sacon.create') }}">Buat Sacon</a>
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
                          Lusi
                        </th>
                        <th>
                          Pakan
                        </th>
                        <th>
                          Sisir
                        </th>
                        <th>
                          Te
                        </th>
                        <th>
                          W
                        </th>
                        <th>
                          J
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
                          Lusi
                        </th>
                        <th>
                          Pakan
                        </th>
                        <th>
                          Sisir
                        </th>
                        <th>
                          Te
                        </th>
                        <th>
                          W
                        </th>
                        <th>
                          J
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
        <h4 class="modal-title" id="modalheader">Edit Sacon</h4>
      </div>
      <div class="modal-body">
        <form id="sacon_form_modal" method="POST" action="" role="form">
          {{ csrf_field() }}
          {{ method_field('put') }}
          <input type="hidden" id="sacon_id" name="sacon_id" >
          <input type="hidden" id="sacon_koreksi" name="sacon_koreksi" >
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>KP</label>
                <input type="text" id="sacon_kp" name="sacon_kp" class="form-control" placeholder="P.QS" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>ITEM</label>
                <input type="text" id="sacon_item" name="sacon_item" class="form-control" placeholder="DTR 1014 SC LOT P43" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>NB1</label>
                <input type="text" id="sacon_nb1" name="sacon_nb1" class="form-control" placeholder="S202 T/B">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>NB2</label>
                <input type="text" id="sacon_nb2" name="sacon_nb2" class="form-control" placeholder="CSY 16+40 GK">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>SISIR</label>
                <input type="text" id="sacon_sisir" name="sacon_sisir" class="form-control" placeholder="33X78">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>TE</label>
                <input type="text" id="sacon_te" name="sacon_te" class="form-control" placeholder="5020">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>W</label>
                <input type="text" id="sacon_w" name="sacon_w" class="form-control" placeholder="i3">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>J</label>
                <input type="text" id="sacon_j" name="sacon_j" class="form-control" placeholder="18000">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" id="sacon_keterangan" name="sacon_keterangan" class="form-control" placeholder="Keterangan">
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

<form method="POST" id="printbarcode" action="/barcode/sacon" target="_blank">
  {{ csrf_field() }}
  <input type="hidden" name="idbarcode" id="idbarcode">
  
  <script type="text/javascript">
    var delayInMilliseconds = 5000; //1 second

    setTimeout(function() {
      $('#sacon-table').DataTable().ajax.reload();
    }, delayInMilliseconds);
  </script>
</form>


<script src="{{asset('/../plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('/../plugins/jquery-validation/additional-methods.min.js')}}"></script>

<script type="text/javascript">

  $('#sacon_form_modal').validate({
     rules: {
       sacon_kp: {
         required: true,
       },
       sacon_item: {
         required: true,
       },
       sacon_nb1: {
         required: true,
       },
       sacon_nb2: {
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
       sacon_j: {
         required: true,
       },
       sacon_keterangan: {
         required: true,
       }
     },
     messages: {
       sacon_kp: {
         required: ""
       },
       sacon_item: {
         required: ""
       },
       sacon_nb1: {
         required: ""
       },
       sacon_nb2: {
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
       sacon_j: {
         required: ""
       },
       sacon_keterangan: {
         required: ""
       }
     },
     errorElement: 'span',
     errorPlacement: function (error, element) {
       error.addClass('invalid-feedback');
       element.closest('.form-group').append(error);
     },
     highlight: function (element, errorClass, validClass) {
       $(element).addClass('is-invalid');
     },
     unhighlight: function (element, errorClass, validClass) {
       $(element).removeClass('is-invalid');
     }
   });
 
 </script>

@endsection