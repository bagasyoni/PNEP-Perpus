@extends('layouts.layout')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Member</h4>
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
                    <h4 class="card-title">Daftar Member</h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>Kode Member</th>
                                    <th>Nama Member</th>
                                    <th>Alamat</th>
                                    <th>Kontak</th>
                                    <th width="30">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($member as $row)
                                <tr>
                                    <td>{{$row->kd_member}}</td>
                                    <td>{{$row->na_member}}</td>
                                    <td>{{$row->alamat}}</td>
                                    <td>{{$row->kontak}}</td>
                                    <td> 
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-info edit" memberid="{{$row->no_id}}">Edit</button>
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-danger delete" memberid="{{$row->no_id}}">Hapus</button>
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
                    <h4 class="modal-title" id="myModalLabel">Tambah Member</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Kode Member</label>
                        <input class="form-control" type="text" id="kd_member" placeholder="Masukkan Kode">
                    </div>
                    <div class="form-group">
                        <label for="username">Nama Member</label>
                        <input class="form-control" type="text" id="na_member" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Alamat</label>
                        <input class="form-control" type="text" id="alamat" placeholder="Masukkan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="username">Kontak</label>
                        <input class="form-control" type="text" id="kontak" placeholder="Masukkan Kontak">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="create">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Modal -->
    <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Data Member</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Kode Member</label>
                        <input class="form-control" type="email" id="edit_kd_member" placeholder="Masukkan Kode" readonly>
                    </div>
                    <div class="form-group">
                        <label for="username">Nama Member</label>
                        <input class="form-control" type="text" id="edit_na_member" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Alamat</label>
                        <input class="form-control" type="text" id="edit_alamat" placeholder="Masukkan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="username">Kontak</label>
                        <input class="form-control" type="text" id="edit_kontak" placeholder="Masukkan Kontak">
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
    var kd_member  =   $('#kd_member').val();
    var na_member  =   $('#na_member').val();
    var alamat  =   $('#alamat').val();
    var kontak  =   $('#kontak').val();
    console.log(kd_member, na_member, alamat, kontak);

    if(kd_member != '' && na_member != '' && alamat != '' && kontak != '') {
        $.ajax({
            url: '{{route("addmember")}}',
            type: 'post',
            data: {kd_member: kd_member, na_member: na_member, alamat: alamat, kontak: kontak, _token: '{{csrf_token()}}'},
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
    var no_id  =   $(this).attr('memberid');
    $.ajax({
        url: '{{route("getmember")}}',
        type: 'post',
        data: {no_id: no_id, _token: '{{csrf_token()}}'},
        success: function(response){
            $('#edit_kd_member').val(response['kd_member']);
            $('#edit_na_member').val(response['na_member']);
            $('#edit_alamat').val(response['alamat']);
            $('#edit_kontak').val(response['kontak']);
            $('#edit_id').val(response['no_id']);
            $('#edit').modal('show');
        }
    });
});

$(document).on('click', '#update', function() {
    var no_id    =   $('#edit_id').val();
    var kd_member  =   $('#edit_kd_member').val();
    var na_member  =   $('#edit_na_member').val();
    var alamat  =   $('#edit_alamat').val();
    var kontak  =   $('#edit_kontak').val();

    if(kd_member != '' && na_member != '' && alamat != '' && kontak != '') {
        $.ajax({
            url: '{{route("updatemember")}}',
            type: 'post',
            data: {no_id: no_id, kd_member: kd_member, na_member: na_member, alamat: alamat, kontak: kontak,  _token: '{{csrf_token()}}'},
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
    var no_id    =   $(this).attr('memberid');
    if (confirm('Apakah anda yakin menghapus data ini ?')) {
        $.ajax({
            type : 'POST',
            url  : '{{route("deletemember")}}',
            data : {no_id: no_id, _token: '{{csrf_token()}}'},
            success : function(response) {
                window.location.reload();
            }
        });
    }
});
</script>
@endpush