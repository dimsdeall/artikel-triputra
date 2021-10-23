@extends('layouts.operator1.operator1')
@section('title', 'Operator1 | Buat Finish')
@section('content')
<div class="col-md-9 col-sm-9 pt-2">
    <!-- general form elements disabled -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title text-white">Buat Finish</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form id="sacon_form" method="POST" action="{{ route('finish.store') }}" role="form">
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
            </div>
            <input type="hidden" name="item" value="{{ $sacon->item }}">
            <input type="hidden" name="id" id="idsacon" value="{{ $sacon->id }}">
            <input type="hidden" name="greige_id" value="{{ $greige->id }}">
            <input type="hidden" name="potong" value="{{ ($datas->count() + 1) }}">
            <div class="text-primary d-flex justify-content-center" ><b>Data {{ ($datas->count() + 1) }}</b></div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="title" name="title" class="form-control" style="text-transform: uppercase" value="{{ old('title') }}"/>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>Potong</label>
                      <input type="number" id="potong" name="potong" class="form-control" style="text-transform: uppercase"/>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>LOT</label>
                      <input type="text" id="lot" name="lot" class="form-control" style="text-transform: uppercase" value="{{ old('lot') }}"/>
                  </div>
              </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Grade</label>
                        <input type="text" id="grade" name="grade" class="form-control" style="text-transform: uppercase" value="{{ old('grade') }}"/>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                        <label>Point</label>
                        <input type="text" id="point" name="point" class="form-control" value="{{ old('point') }}" style="text-transform: uppercase">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                        <label>YDS</label>
                        <input type="number" id="yds" name="yds" class="form-control" style="text-transform: uppercase" value="{{ old('yds') }}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                        <label>KG</label>
                        <input type="number" id="kg" name="kg" class="form-control" style="text-transform: uppercase" value="{{ old('kg') }}">
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                          <label>Lebar</label>
                          <input type="text" id="lebar" name="lebar" class="form-control" style="text-transform: uppercase" value="{{ old('lebar') }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>SN</label>
                        <input type="text" id="sn" name="sn" class="form-control" style="text-transform: uppercase" value="{{ $greige->sn }}" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>K3L</label>
                      <input type="text" id="k3l" name="k3l" class="form-control" style="text-transform: uppercase" value="{{ old('k3l') }}">
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Inisial</label>
                        <input type="text" id="inisial" name="inisial" class="form-control" style="text-transform: uppercase" value="{{ old('inisial') }}">
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>Susut Lusi</label>
                      <input type="text" id="susutlusi" name="susutlusi" class="form-control" style="text-transform: uppercase" value="{{ old('susutlusi') }}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>K</label>
                      <input type="text" id="k" name="k" class="form-control" style="text-transform: uppercase" value="{{ old('k') }}"  required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>Actual</label>
                      <input type="text" id="actual" name="actual" class="form-control" style="text-transform: uppercase" value="{{ $sacon->actual }}" readonly  required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>TGL</label>
                      <input type="date" id="tgl" name="tgl" class="form-control" style="text-transform: uppercase" value="{{ old('tgl') }}"  required>
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
      
      window.open('/finish?kp='+kp,'_self')

      return false;
  }
  // ajaxfinisnsn();
  function ajaxfinisnsn() {
    var idgrade = document.getElementById('potong').value;
    var idsacon = document.getElementById('idsacon').value;
    $.ajax({
        type: 'POST',
        url: '/operator1/finish/sn',
        data: {_token: "{{ csrf_token() }}", grade : idgrade, sacon : idsacon},
        success: function (data) {     
            document.getElementById('sn').value = data;
        },
        error: function (xhr) {
          //Do Something to handle error
          alert(xhr.responseText);
        }
    });

  }
</script>
@endsection