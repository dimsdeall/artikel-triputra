@extends('layouts.operator1.operator1')
@section('title', 'Operator | Buat Indigo')
@section('content')
<div class="col-md-9 col-sm-9 pt-2">
    <!-- general form elements disabled -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title text-white">Buat Indigo</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form id="sacon_form" method="POST" action="{{ route('indigo.store') }}" role="form">
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
              <div class="col-sm-2 col-2">
                <label>NE</label>
              </div>
              <div class="col-sm-10 col-10">
                <label>{{ ': '.$sacon->lusi }}</label>
              </div>
            </div>
            <input type="hidden" name="item" value="{{ $sacon->item }}">
            <input type="hidden" name="id" value="{{ $sacon->id }}">
            <div class="text-primary d-flex justify-content-center" ><b>Data Beam</b></div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>LOT</label>
                      <input type="text" id="lot" name="lot" class="form-control" style="text-transform: uppercase" value="{{ old('lot') }}"  required>
                      </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Warping Asal</label>
                        <select name="warping_id" id="warping_id" class="form-control">
                            @foreach ($nb as $item)
                              <option value="{{ $item->id }}">{{ 'LOT :'.$item->lot.'| NB :'.$item->nb.'| P :'.$item->p.'| B :'.$item->b }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>Beam WV</label>
                          <input type="number" id="nb" name="nb" class="form-control" style="text-transform: uppercase" value="{{ old('nb') }}" required>
                      </div>
                      @if ($errors->any())
                        <script>document.getElementById("nb").style.borderColor = "red";</script>
                      @endif
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>TE</label>
                      <input type="text" id="te" name="te" class="form-control" style="text-transform: uppercase" value="{{ old('te') }}"  required>
                      </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>MC IDG</label>
                        <input type="text" id="mc_idg" name="mc_idg" class="form-control" style="text-transform: uppercase" value="{{ old('mc_idg') }}" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Warna</label>
                        <input type="text" id="w" name="w" class="form-control" style="text-transform: uppercase" value="{{ $sacon->w }}" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>Panjang</label>
                          <input type="number" id="p" name="p" class="form-control" style="text-transform: uppercase" value="{{ old('p') }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Berat</label>
                          <input type="number" id="b" name="b" class="form-control" style="text-transform: uppercase" value="{{ old('b') }}" required>
                      </div>
                    </div>
                </div>
                <br><br>
                <div class="float-right">
                    <button type="submit" name="btnstatus" value="stop" class="btn btn-primary ">SUBMIT</button>
                    <button type="submit" name="btnstatus" value="next" class="btn btn-success ">SUBMIT NEXT</button>
                  </div>
                  <div class="float-left">
                      <button onclick="return backurl();" class="btn btn-danger ">BACK</button>
                </div>
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
      lot: {
        required: true,
      },
      nb: {
        required: true,
      },
      te: {
        required: true,
      },
      mc_idg: {
        required: true,
      },
      p: {
        required: true,
      },
      b: {
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
      mc_idg: {
        required: ""
      },
      p: {
        required: ""
      },
      b: {
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

  function backurl(){
      var url_string = window.location.href;
      var url = new URL(url_string);
      var kp = url.searchParams.get("kp");
      
      window.open('/indigo?kp='+kp,'_self')

      return false;
  }
</script>
@endsection