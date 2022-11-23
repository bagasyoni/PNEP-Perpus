@extends('layouts.layout')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Users</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card-group">
        <button type="button" class="btn waves-effect waves-light btn-lg btn-primary" data-toggle="modal" data-target="#add">Tambah Data</button>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Users</h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th width="30">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $row)
                                <tr>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->name}}</td>
                                    @if($row->role == 'Administrator')
                                        <td><span class="badge badge-danger ml-auto">{{$row->role}}</span></td>
                                    @else
                                    <td><span class="badge badge-info ml-auto">{{$row->role}}</span></td>
                                    @endif
                                    <td> 
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-info edit" userid="{{$row->id}}">Edit</button>
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-danger delete" userid="{{$row->id}}">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah Data User</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input class="form-control" type="email" id="email" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group">
                        <label for="username">Nama</label>
                        <input class="form-control" type="text" id="name" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Password</label>
                        <input class="form-control" type="password" id="password" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select class="form-control" id="role">
                            <option value="">Pilih</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Pengawas">Pengawas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="create">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Modal -->
    <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Data User</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input class="form-control" type="email" id="edit_email" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group">
                        <label for="username">Nama</label>
                        <input class="form-control" type="text" id="edit_name" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Password</label>
                        <input class="form-control" type="password" id="edit_password" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select class="form-control" id="edit_role">
                            <option value="">Pilih</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Pengawas">Pengawas</option>
                        </select>
                    </div>
                    <input type="hidden" id="edit_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).on('click', '#create', function() {
    var email       =   $('#email').val();
    var name        =   $('#name').val();
    var password    =   $('#password').val();
    var role        =   $('#role').val();

    if(email != '' && name != '' && password != '' && role != '') {
        $.ajax({
            url: '{{route("adduser")}}',
            type: 'post',
            data: {email: email, name: name, password: password, role: role, _token: '{{csrf_token()}}'},
            success: function(response){
                $('#add').modal('hide');
                window.location.reload();
            }
        });
    } else {
        alert('Fill all fields');
    }
});

$(document).on('click', '.edit', function() {
    var id  =   $(this).attr('userid');
    $.ajax({
        url: '{{route("getuser")}}',
        type: 'post',
        data: {id: id, _token: '{{csrf_token()}}'},
        success: function(response){
            $('#edit_email').val(response['email']);
            $('#edit_name').val(response['name']);
            $('#edit_role').val(response['role']);
            $('#edit_id').val(response['id']);
            $('#edit').modal('show');
        }
    });
});

$(document).on('click', '#update', function() {
    var id          =   $('#edit_id').val();
    var email       =   $('#edit_email').val();
    var name        =   $('#edit_name').val();
    var password    =   $('#edit_password').val();
    var role        =   $('#edit_role').val();

    if(email != '' && name != '' && password != '' && role != '') {
        $.ajax({
            url: '{{route("updateuser")}}',
            type: 'post',
            data: {id: id, email: email, name: name, password: password, role: role, _token: '{{csrf_token()}}'},
            success: function(response){
                $('#update').modal('hide');
                window.location.reload();
            }
        });
    } else {
        alert('Fill all fields');
    }
});

$(document).on('click', '.delete', function() {
    var id    =   $(this).attr('userid');
    if (confirm('Apakah anda yakin menghapus data ini ?')) {
        $.ajax({
            type : 'POST',
            url  : '{{route("deleteuser")}}',
            data : {id: id, _token: '{{csrf_token()}}'},
            success : function(response) {
                window.location.reload();
            }
        });
    }
});
</script>
@endpush