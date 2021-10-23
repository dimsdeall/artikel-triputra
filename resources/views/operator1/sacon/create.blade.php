@extends('layouts.operator1.operator1')
@section('title', 'Operator1 | Buat Sacon')
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
          @if ($errors->any())
              <div class="alert alert-danger" >
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>KP</label>
                <input type="text" id="sacon_kp" name="sacon_kp" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_kp') }}" >
              </div>
              @if ($errors->any())
              <script>document.getElementById("sacon_kp").style.borderColor = "red";</script>
              @endif
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>ITEM</label>
                <input type="text" id="sacon_item" name="sacon_item" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_item') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>LOT</label>
                <input type="text" id="sacon_lot" name="sacon_lot" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_lot') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>LUSI</label>
                <input type="text" id="sacon_lusi" name="sacon_lusi" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_lusi') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>BALL</label>
                <input type="text" id="sacon_ball1" name="sacon_ball1" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_ball1') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>KG</label>
                <input type="text" id="sacon_kg1" name="sacon_kg1" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_kg1') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>CONES</label>
                <input type="text" id="sacon_cones1" name="sacon_cones1" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_cones1') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>PAKAN</label>
                <input type="text" id="sacon_pakan" name="sacon_pakan" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_pakan') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>BALL</label>
                <input type="text" id="sacon_ball2" name="sacon_ball2" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_ball2') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>KG</label>
                <input type="text" id="sacon_kg2" name="sacon_kg2" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_kg2') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>CONES</label>
                <input type="text" id="sacon_cones2" name="sacon_cones2" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_cones2') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>SISIR</label>
                <input type="text" id="sacon_sisir" name="sacon_sisir" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_sisir') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>TE</label>
                <input type="text" id="sacon_te" name="sacon_te" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_te') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>WARNA</label>
                <input type="text" id="sacon_w" name="sacon_w" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_w') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Panjang</label>
                <input type="number" id="sacon_p" name="sacon_p" class="form-control" onkeyup="rumus_actual()" style="text-transform: uppercase" value="{{ old('sacon_p') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>SUSUT</label>
                <input type="number" id="sacon_susut" name="sacon_susut" onkeyup="rumus_actual()" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_susut') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Actual</label>
                <input type="text" id="sacon_actual" name="sacon_actual" class="form-control" style="text-transform: uppercase" value="{{ old('sacon_actual') }}" readonly>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button class="btn btn-primary">SUBMIT</button>
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

  rumus_actual();
  function rumus_actual(){
    let panjang = document.getElementById('sacon_p').value;
    let susut = document.getElementById('sacon_susut').value;
    let actual = 0;

    if (panjang == '') panjang = 0;
    if (susut == '') susut = 0;

    actual = panjang - (panjang * susut); 

    document.getElementById('sacon_actual').value = actual.toFixed(2);
  }
</script>
@endsection