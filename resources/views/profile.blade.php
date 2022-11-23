@extends('layouts.layout')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">My Profile</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input class="form-control" type="text" id="email" value="{{$user->email}}" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group">
                        <label for="username">Nama</label>
                        <input class="form-control" type="text" id="name" value="{{$user->name}}" placeholder="Masukkan Nama Anda">
                    </div>
                    <div class="form-group">
                        <label for="username">New Password</label>
                        <input class="form-control" type="password" id="password" placeholder="Masukkan Password baru">
                    </div>
                    <input type="hidden" value="{{$user->id}}" id="userid">
                    <button type="button" class="btn waves-effect waves-light btn-block btn-primary" id="update">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).on('click', '#update', function() {
    var id          =   $('#userid').val();
    var email       =   $('#email').val();
    var name        =   $('#name').val();
    var password    =   $('#password').val();

    if(userid != '' && email != '' && name != '' && password != '') {
        $.ajax({
            url: '{{route("updateprofile")}}',
            type: 'post',
            data: {id: id, email: email, name: name, password: password, _token: '{{csrf_token()}}'},
            success: function(response){
                window.location.reload();
            }
        });
    } else {
        alert('Fill all fields');
    }
});
</script>
@endpush