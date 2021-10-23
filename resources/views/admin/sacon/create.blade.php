@extends('layouts.admin.admin')
@section('title', 'Admin | Buat Sacon')
@section('content')
<div class="col-md-9 col-sm-9 pt-2">
    <!-- general form elements disabled -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title text-white">Buat Sacon</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form id="sacon_form" method="POST" action="{{ route('sacon.store') }}" role="form">
          {{ csrf_field() }}
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
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary ">SUBMIT</button>
          </div>
          </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <script src="{{asset('/../plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('/../plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script type="text/javascript">

 $('#sacon_form').validate({
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