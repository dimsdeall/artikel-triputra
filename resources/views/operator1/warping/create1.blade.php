@extends('layouts.operator1.operator1')
@section('title', 'Operator | Buat Warping')
@section('content')
<div class="col-md-9 col-sm-9 pt-2">
    <!-- general form elements disabled -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title text-white">Buat Warping</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form id="sacon_form" method="POST" action="{{ route('warping.store') }}" role="form">
            {{ csrf_field() }}
            <div class="row"> 
              <div class="col-sm-2 col-2">
                    <label>KP</label>
              </div>
              <div class="col-sm-10 col-10">
                <label>{{ ': '.$datas->kp }}</label>
              </div>
              <div class="col-sm-2 col-2">
                <label>Item</label>
              </div>
              <div class="col-sm-10 col-10">
                <label>{{ ': '.$datas->item }}</label>
              </div>
            </div>
            <input type="hidden" name="item" value="{{ $datas->item }}">
            <input type="hidden" name="id" value="{{ $datas->id }}">
            <input type="hidden" name="lenght" value="{{ $_GET['jmlpotong'] }}">
            @for($i = 0;$i < $_GET['jmlpotong'];$i++)
                <div class="text-primary d-flex justify-content-center" ><b>Data Potong {{ ($i+1) }}</b></div>
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>No Beam</label>
                          <input type="text" id="nb[]" name="nb[]" class="form-control" placeholder="Example:123456" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Panjang</label>
                          <input type="text" id="p[]" name="p[]" class="form-control" placeholder="Example:123456" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Berat</label>
                          <input type="text" id="b[]" name="b[]" class="form-control" placeholder="Example:123456" required>
                      </div>
                    </div>
                </div>
                <br><br>
            @endfor
            <button type="submit" class="btn btn-primary ">SUBMIT</button>
          </div>
          </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection