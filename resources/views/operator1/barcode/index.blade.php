@extends('layouts.operator1.operator1')
@section('title', 'Operator | Cek Barcode')
@section('content')
<div class="col-md-12 col-sm-12 pt-2">
    <!-- general form elements disabled -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title text-white">Cek Barcode</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-8 col-lg-10">
            <div class="form-group">
              <input type="text" id="barcodeid" name="barcodeid" class="form-control" placeholder="example: B22143DSA" required style="text-transform: uppercase" autocomplete="false">
            </div>
          </div>
          <div class="col-2 col-lg-2">
            <button type="submit" class="btn btn-primary" onclick="ajaxbarcode()">SUBMIT</button> 
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

  <div class="modal fade" id="listdiv1modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Daftar Proses</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <form action="{{ route('warping.index') }}" method="GET">
                        <input type="hidden" id="barcodekpwarping" name="barcodekpwarping">
                        <button class="btn btn-success col-12" id="btnwarping">Warping</button>
                      </form>
                    </div>
                    <div class="col-6">
                      <form action="{{ route('indigo.index') }}" method="GET">
                        <input type="hidden" id="barcodekpindigo" name="barcodekpindigo">
                        <button class="btn btn-warning col-12 text-white" id="btnindigo">Indigo</button>
                      </form>
                    </div>    
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
            </div>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="listdiv2modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Daftar Proses</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <form action="{{ route('weaving.index') }}" method="GET">
                        <input type="hidden" id="barcodekpweaving" name="barcodekpweaving">
                        <button class="btn bg-maroon col-12" id="btnweaving">Weaving</button>
                      </form>
                    </div>
                    <div class="col-6">
                      <form action="{{ route('greige.index') }}" method="GET">
                        <input type="hidden" id="barcodekpgreige" name="barcodekpgreige" >
                        <button class="btn bg-orange col-12 text-blue" id="btngreige">Greige</button>
                      </form>
                    </div>    
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
            </div>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="warpingmodal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemodalsm">Warping</h4>
            </div>
            <div class="modal-body">
              <div class="row d-flex justify-content-center">
                <div class="form-group">
                  <label>Potong :</label>
                  <select name="potong" class="form-control" onchange="document.getElementById('jmlpotong').value = this.value" id="potong">
                    @for ($i = 0; $i < 20; $i++)
                      <option value="{{ ($i+1) }}">{{ ($i+1) }}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <form action="{{ route('warping.create') }}" method="GET">
                <input type="hidden" name="jmlpotong" id="jmlpotong" value="1">
                <input type="hidden" name="barcodeitem" id="barcodeitem">
                <button class="btn btn-success">Buat Warping</button>
              </form>
            </div>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="indigomodal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemodalsm">Indigo</h4>
            </div>
            <div class="modal-body">
              <div class="row d-flex justify-content-center">
                <div class="form-group">
                  <form action="{{ route('indigo.create') }}" method="GET">
                    <input type="hidden" name="barcodeitemindigo" id="barcodeitemindigo">
                    <button class="btn btn-warning text-white">Buat Indigo</button>
                  </form>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>

  <div class="modal fade" id="finishmodal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemodalsm">Finish</h4>
            </div>
            <div class="modal-body">
              <div class="row d-flex justify-content-center">
                <div class="form-group">
                  <form action="{{ route('finish.index') }}" method="GET">
                    <input type="hidden" name="barcodeitemfinish" id="barcodeitemfinish">
                    <button class="btn btn-primary text-white">Buat Finish</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
            </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>

  <div class="modal fade" id="donemodal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="titlemodalsm">Result</h4>
          </div>
          <div class="modal-body">
            <div class="row d-flex justify-content-center">
              Data Item ini telah selesai. . .
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal">OK</button>
          </div>
      </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="blankmodal" index='123'>
  <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Result</h4>
          </div>
          <div class="modal-body">
            <div class="row d-flex justify-content-center">
              Data Item ini tidak ditemukan. . .
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal">OK</button>
          </div>
      </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->  
</div>
<!-- /.modal -->
<script type="text/javascript">
  $( "#barcodeid" ).focus();
  function ajaxbarcode() {
    let res = document.getElementById('barcodeid').value;
    res = res.split('|');
    var idbarcode = res[0];
    var divisi = {{ Auth::user()->status }};
    $.ajax({
        type: 'POST',
        url: '/operator1/cekbarcode/data',
        data: {_token: "{{ csrf_token() }}", barcodeid : idbarcode},
        success: function (data) {           
          // if (data == 'warping') {
          //   $('#warpingmodal').modal('show');
          //   $('#barcodeitem').val(idbarcode);
          // }else if(data == 'indigo'){
          //   $('#indigomodal').modal('show');
          //   $('#barcodeitemindigo').val(idbarcode);
          // }else if(data == 'done'){
          //   $('#donemodal').modal('show');
          // }else if(data == 'blank'){
          //   $('#blankmodal').modal('show');
          // }
          if(divisi == 1){
            if (data == 'warping') {
              $('#listdiv1modal').modal('show');
              $('#barcodekpwarping').val(idbarcode);
              $('#btnindigo').attr("disabled", true);
            }else if (data == 'indigo' || data == 'weaving' || data == 'greige') {
              $('#listdiv1modal').modal('show');
              $('#barcodekpwarping').val(idbarcode);
              $('#barcodekpindigo').val(idbarcode);
            }
          }
          else if(divisi == 2){
            if (data == 'weaving') {
              $('#listdiv2modal').modal('show');
              $('#barcodekpweaving').val(idbarcode);
              $('#btngreige').attr("disabled", true);
            }else if (data == 'greige') {
              $('#listdiv2modal').modal('show');
              $('#barcodekpweaving').val(idbarcode);
              $('#barcodekpgreige').val(idbarcode);
            }else{
              $('#blankmodal').modal('show');
            }
          }
          else if(divisi == 5){
            if (data == 'greige') {
              $('#finishmodal').modal('show');
              $('#barcodeitemfinish').val(idbarcode);
            }
          }
        },
        error: function (xhr) {
          //Do Something to handle error
          alert(xhr.responseText);
        }
    });

  }

  $('#barcodeid').keypress(function (e) {
    var key = e.which;
    if(key == 13)  // the enter key code
      {
        return ajaxbarcode();  
      }
  });  
</script>

@endsection