@extends('layouts.admin.admin')
@section('title', 'Admin | User')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#user-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                method: 'GET',
                ajax: "{{ URL::to('/user/admin/getdata') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'roles',
                        name: 'roles'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            role();
        });

        $(document).on('click', '#editmodal', function() {
            $('#user_edit_id').val($(this).data('id'));
            $('#user_edit_nama').val($(this).data('name'));
            $('#user_edit_username').val($(this).data('username'));

            role_edit($(this).data('role'));
        });

        $(document).on('click', '#btnprint', function() {
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
                <h3 class="card-title text-white">Data user</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <button class="btn btn-primary" onclick="$('#modal-user-add').modal('show');">Buat user</button>
                <div class="row pt-2">
                    <div class="table-responsive">
                        <table id="user-table" class="table table-sm table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Username
                                    </th>
                                    <th>
                                        Role
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
                                        No
                                    </th>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Username
                                    </th>
                                    <th>
                                        Role
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

    <div id="modal-user-add" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah User</h4>
                </div>
                <div class="modal-body">
                    <form id="form-user-add" method="dialog" enctype="multipart/form-data">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="user_nama" name="user_nama" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" id="user_username" name="user_username" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="user_password" name="user_password" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="user_role" id="user_role" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="user_repassword" name="user_repassword" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button onclick="store();" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div id="modal-user-edit" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                    <form id="form-user-edit" method="dialog" enctype="multipart/form-data">
                        <div class="row">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <input type="hidden" id="user_edit_id" name="user_edit_id">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="user_edit_nama" name="user_edit_nama" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" id="user_edit_username" name="user_edit_username"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="user_edit_password" name="user_edit_password"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="user_edit_role" id="user_edit_role" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="user_edit_repassword" name="user_edit_repassword"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button onclick="edit();" class="btn btn-primary mr-2">SUBMIT</button>
                            <button onclick="remove();" type="button" class="btn btn-danger">DELETE</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <script src="{{ asset('/../plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/../plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        let form_user_add = $('#form-user-add');
        let form_user_edit = $('#form-user-edit');
        form_user_add.validate({
            rules: {
                "user_nama": {
                    required: true,
                },
                "user_username": {
                    required: true,
                },
                "user_password": {
                    required: true,
                },
                "user_repassword": {
                    equalTo: "#user_password",
                }
            },
            messages: {
                "user_nama": {
                    required: "",
                },
                "user_username": {
                    required: "",
                },
                "user_password": {
                    required: "",
                },
                "user_repassword": {
                    equalTo: "Password Tidak Sama",
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        })

        form_user_edit.validate({
            rules: {
                "user_edit_nama": {
                    required: true,
                },
                "user_edit_username": {
                    required: true,
                },
                "user_edit_password": {
                    //   required: true,
                },
                "user_edit_repassword": {
                    equalTo: "#user_edit_password",
                }
            },
            messages: {
                "user_edit_nama": {
                    required: "",
                },
                "user_edit_username": {
                    required: "",
                },
                "user_edit_password": {
                    // required: "",
                },
                "user_edit_repassword": {
                    equalTo: "Password Tidak Sama",
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        })

        function role() {
            $.ajax({
                type: 'POST',
                url: '/admin/role/getdata',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#user_role').html(data);
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });

        }

        function role_edit(id) {
            $.ajax({
                type: 'POST',
                url: '/admin/role/getdata',
                data: {
                    _token: "{{ csrf_token() }}",
                    role: id
                },
                success: function(data) {
                    $('#user_edit_role').html(data);
                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });

        }

        function store() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000
            });

            let form = document.getElementById('form-user-add');
            let fd = new FormData(form);
            if (form_user_add.valid()) {
                $.ajax({
                    type: 'POST',
                    url: '/user',
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function(data) {
                        console.log(data);
                        if (data == 'success') {
                            Toast.fire({
                                type: 'success',
                                title: 'User telah di tambah'
                            })
                            $('#modal-user-add').modal('hide');
                            $('#user-table').DataTable().ajax.reload(null, false);
                            $('#form-user-add').trigger("reset");
                        } else if (data == 'ada') {
                            Toast.fire({
                                type: 'warning',
                                title: 'Username sudah terdaftar'
                            })
                        } else {
                            Toast.fire({
                                type: 'error',
                                title: 'Terjadi kesalahan'
                            })
                        }

                    },
                    error: function(xhr) {
                        //Do Something to handle error
                        alert(xhr.responseText);
                    }
                });
            }
        };

        function edit() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000
            });

            let form = document.getElementById('form-user-edit');
            let fd = new FormData(form);

            // for (var pair of fd.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
            if (form_user_edit.valid()) {
                $.ajax({
                    type: 'POST',
                    url: '/user/' + $('#user_edit_id').val(),
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function(data) {
                        console.log(data);
                        if (data == 'success') {
                            Toast.fire({
                                type: 'success',
                                title: 'User telah di edit'
                            })
                            $('#modal-user-edit').modal('hide');
                            $('#user-table').DataTable().ajax.reload(null, false);
                        } else if (data == 'ada') {
                            Toast.fire({
                                type: 'warning',
                                title: 'Username sudah terdaftar'
                            })
                        } else {
                            Toast.fire({
                                type: 'error',
                                title: 'Terjadi kesalahan'
                            })
                        }

                    },
                    error: function(xhr) {
                        //Do Something to handle error
                        alert(xhr.responseText);
                    }
                });
            }
        };

        function remove() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000
            });



            $.ajax({
                type: 'DELETE',
                url: '/user/' + $('#user_edit_id').val(),
                data: {
                    'id': $('#user_edit_id').val(),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    // console.log(data);
                    if (data == 'success') {
                        Toast.fire({
                            type: 'success',
                            title: 'User telah di hapus'
                        })
                        $('#modal-user-edit').modal('hide');
                        $('#user-table').DataTable().ajax.reload(null, false);
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data
                        })
                    }

                },
                error: function(xhr) {
                    //Do Something to handle error
                    alert(xhr.responseText);
                }
            });

        };

    </script>
@endsection
