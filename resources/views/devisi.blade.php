@extends('layouts.layout')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Devisi</h4>
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
                    <h4 class="card-title">Daftar Devisi</h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>Kode Devisi</th>
                                    <th>Nama Devisi</th>
                                    <th width="30">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devisi as $row)
                                <tr>
                                    <td>{{$row->kd_dev}}</td>
                                    <td>{{$row->na_dev}}</td>
                                    <td> 
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-info edit" devisiid="{{$row->no_id}}">Edit</button>
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-danger delete" devisiid="{{$row->no_id}}">Hapus</button>
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
                    <h4 class="modal-title" id="myModalLabel">Tambah Devisi</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Kode Devisi</label>
                        <input class="form-control" type="text" id="kd_dev" placeholder="Masukkan Kode">
                    </div>
                    <div class="form-group">
                        <label for="username">Nama Devisi</label>
                        <input class="form-control" type="text" id="na_dev" placeholder="Masukkan Nama">
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Role</label>
                        <select class="form-control" id="role">
                            <option value="">Pilih</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Pengawas">Pengawas</option>
                        </select>
                    </div> -->
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
                    <h4 class="modal-title" id="myModalLabel">Edit Data Devisi</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Kode Devisi</label>
                        <input class="form-control" type="email" id="edit_kd_dev" placeholder="Masukkan Kode" readonly readonly>
                    </div>
                    <div class="form-group">
                        <label for="username">Nama Devisi</label>
                        <input class="form-control" type="text" id="edit_na_dev" placeholder="Masukkan Nama">
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Role</label>
                        <select class="form-control" id="edit_role">
                            <option value="">Pilih</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Pengawas">Pengawas</option>
                        </select>
                    </div> -->
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
    var kd_dev  =   $('#kd_dev').val();
    var na_dev  =   $('#na_dev').val();
    console.log(kd_dev, na_dev);

    if(kd_dev != '' && na_dev != '') {
        $.ajax({
            url: '{{route("adddevisi")}}',
            type: 'post',
            data: {kd_dev: kd_dev, na_dev: na_dev, _token: '{{csrf_token()}}'},
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
    var no_id  =   $(this).attr('devisiid');
    $.ajax({
        url: '{{route("getdevisi")}}',
        type: 'post',
        data: {no_id: no_id, _token: '{{csrf_token()}}'},
        success: function(response){
            $('#edit_kd_dev').val(response['kd_dev']);
            $('#edit_na_dev').val(response['na_dev']);
            $('#edit_id').val(response['no_id']);
            $('#edit').modal('show');
        }
    });
});

$(document).on('click', '#update', function() {
    var no_id    =   $('#edit_id').val();
    var kd_dev  =   $('#edit_kd_dev').val();
    var na_dev  =   $('#edit_na_dev').val();

    if(kd_dev != '' && na_dev != '') {
        $.ajax({
            url: '{{route("updatedevisi")}}',
            type: 'post',
            data: {no_id: no_id, kd_dev: kd_dev, na_dev: na_dev,  _token: '{{csrf_token()}}'},
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
    var no_id    =   $(this).attr('devisiid');
    if (confirm('Apakah anda yakin menghapus data ini ?')) {
        $.ajax({
            type : 'POST',
            url  : '{{route("deletedevisi")}}',
            data : {no_id: no_id, _token: '{{csrf_token()}}'},
            success : function(response) {
                window.location.reload();
            }
        });
    }
});
</script>
@endpush