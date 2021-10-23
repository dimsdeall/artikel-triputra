@extends('layouts.operator1.operator1')
@section('title', 'Operator1 | Buat Greige')
@section('content')
<div class="col-md-9 col-sm-9 pt-2">
    <!-- general form elements disabled -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title text-white">Buat Greige</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form id="sacon_form" method="POST" action="{{ route('greige.store') }}" role="form">
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
            <div class="text-primary d-flex justify-content-center" ><b>Data</b></div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>P Item</label>
                        <select type="text" id="pitem" name="pitem" class="form-control" onchange="ajaxpotong()" style="text-transform: uppercase">
                          @foreach ($weaving as $item)
                            <option value="{{ $item->pitem }}"> {{ $item->pitem }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>Potongan</label>
                      <select type="number" id="potong" name="potong" class="form-control" onchange="snchange()" style="text-transform: uppercase">

                      </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>SN</label>
                      <input type="text" id="sn" name="sn" class="form-control" style="text-transform: uppercase"  readonly required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Shift</label>
                    <input type="text" id="shift" name="shift" class="form-control" style="text-transform: uppercase" value="{{ old('shift') }}"  required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>OPR</label>
                    <input type="text" id="opr" name="opr" class="form-control" style="text-transform: uppercase" value="{{ old('opr') }}"  required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>Grade</label>
                      <input type="txt" id="grade" name="grade" class="form-control" style="text-transform: uppercase" value="{{ old('grade') }}"  required>
                  </div>
              </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Panjang</label>
                        <input type="number" id="p" name="p" class="form-control" style="text-transform: uppercase" value="{{ old('p') }}"  required>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>Berat</label>
                      <input type="number" id="b" name="b" class="form-control" style="text-transform: uppercase" value="{{ old('b') }}"  required>
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
      var barcodekpgreige = url.searchParams.get("barcodekpgreige");
      
      window.open('/greige?barcodekpgreige='+barcodekpgreige,'_self')

      return false;
  }
  ajaxpotong();
  function ajaxpotong() {
    let item= document.getElementById('pitem').value;
    let idsacon = document.getElementById('idsacon').value;
    $.ajax({
        type: 'POST',
        url: '/operator1/potong/data',
        data: {_token: "{{ csrf_token() }}", pitem : item, sacon : idsacon},
        success: function (data) {    
          let res = data.split('|');   
          document.getElementById('potong').innerHTML = res[0];
          document.getElementById('sn').value = res[1];
        },
        error: function (xhr) {
          //Do Something to handle error
          alert(xhr.responseText);
        }
    });

  }

  function snchange(){
    let potong = document.getElementById('potong').value;
    $.ajax({
        type: 'POST',
        url: '/operator1/sn/data',
        data: {_token: "{{ csrf_token() }}", potongan : potong},
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