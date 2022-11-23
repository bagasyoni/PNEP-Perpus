@extends('layouts.layout')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data TPS</h4>
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
                    <h4 class="card-title">Daftar TPS</h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>Nama TPS</th>
                                    <th>Nama Pengawas</th>
                                    <th>Address</th>
                                    <th width="30">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tps as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    @if($row->pengawas == '')
                                        <td><span class="badge badge-danger ml-auto">Pengawas Belum Ditentukan</span></td>
                                    @else
                                        <td>{{$row->pengawas}}</td>
                                    @endif
                                    <td>{{$row->address}}</td>
                                    <td> 
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-info edit" tpsid="{{$row->id}}">Edit</button>
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-danger delete" tpsid="{{$row->id}}">Hapus</button>
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
                    <h4 class="modal-title" id="myModalLabel">Tambah Data TPS</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Nama</label>
                        <input class="form-control" type="text" id="name" placeholder="Masukkan Nama TPS">
                    </div>
                    <div class="form-group">
                        <label for="username">Alamat</label>
                        <textarea class="form-control" rows="4" id="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Pengawas</label>
                        <select class="form-control" id="userid">
                            <option value="">Pilih</option>
                            @foreach($pengawas as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
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
                    <h4 class="modal-title" id="myModalLabel">Edit Data TPS</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Nama</label>
                        <input class="form-control" type="text" id="edit_name" placeholder="Masukkan Nama TPS">
                    </div>
                    <div class="form-group">
                        <label for="username">Alamat</label>
                        <textarea class="form-control" rows="4" id="edit_address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Pengawas</label>
                        <select class="form-control" id="edit_userid">
                            <option value="">Pilih</option>
                            @foreach($pengawas2 as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
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
    var name        =   $('#name').val();
    var address     =   $('#address').val();
    var userid      =   $('#userid').val();

    if(name != '' && address != '') {
        $.ajax({
            url: '{{route("addtps")}}',
            type: 'post',
            data: {name: name, address: address, userid: userid, _token: '{{csrf_token()}}'},
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
    var id  =   $(this).attr('tpsid');
    $.ajax({
        url: '{{route("gettps")}}',
        type: 'post',
        data: {id: id, _token: '{{csrf_token()}}'},
        success: function(response){
            $('#edit_name').val(response['name']);
            $('#edit_address').val(response['address']);
            $('#edit_userid').val(response['user_id']);
            $('#edit_id').val(response['id']);
            $('#edit').modal('show');
        }
    });
});

$(document).on('click', '#update', function() {
    var id  =   $('#edit_id').val();
    var name    =   $('#edit_name').val();
    var address     =   $('#edit_address').val();
    var userid  =   $('#edit_userid').val();
    $.ajax({
        url: '{{route("updatetps")}}',
        type: 'post',
        data: {id: id, name: name, address: address, userid: userid, _token: '{{csrf_token()}}'},
        success: function(response){
            if(response['status'] == 'error') {
                alert(response['message'])
            } else {
                $('#update').modal('hide');
                window.location.reload();
            }

        }
    });
});

$(document).on('click', '.delete', function() {
    var id    =   $(this).attr('tpsid');
    if (confirm('Apakah anda yakin menghapus data ini ?')) {
        $.ajax({
            type : 'POST',
            url  : '{{route("deletetps")}}',
            data : {id: id, _token: '{{csrf_token()}}'},
            success : function(response) {
                window.location.reload();
            }
        });
    }
});
</script>
@endpush