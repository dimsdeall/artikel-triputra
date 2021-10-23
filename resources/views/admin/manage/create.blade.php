@extends('layouts.admin.admin')
@section('title', 'Admin | Buat User')
@section('content')

<div class="col-md-9 col-sm-9 pt-2">
    <!-- general form elements disabled -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title text-white">Buat User</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form id="user_form" method="POST" action="{{ route('user.store') }}" role="form">
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
                <label>Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Username</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" >
              </div>
                @if ($errors->any())
                    <script>document.getElementById("username").style.borderColor = "red";</script>
                @endif
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Role</label>
                <select name="role" id="role" class="form-control" onchange="ajaxdivisi()">
                    @foreach ($role as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Divisi</label>
                <select name="divisi" id="divisi" class="form-control">

                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" >
              </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" id="password_confirm" name="password_confirm" class="form-control" value="{{ old('password_confirm') }}" >
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

 $('#user_form').validate({
    rules: {
      nama: {
        required: true,
      },
      username: {
        required: true,
      },
      role: {
        required: true,
      },
      divisi: {
        required: true,
      },
      password: {
        required: true,
      },
      password_confirm : {
        equalTo : "#password",
      }
    },
    messages: {
      nama: {
        required: ""
      },
      username: {
        required: ""
      },
      role: {
        required: ""
      },
      divisi: {
        required: ""
      },
      password: {
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

  ajaxdivisi();
  function ajaxdivisi() {

    var idrole = document.getElementById('role').value;
    $.ajax({
        type: 'POST',
        url: '/admin/manage/divisi',
        data: {_token: "{{ csrf_token() }}",  role : idrole},
        success: function (data) {     
            document.getElementById('divisi').innerHTML = data;
        },
        error: function (xhr) {
          //Do Something to handle error
          alert(xhr.responseText);
        }
    });

  }
</script>
@endsection