@extends('layouts.layout')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Genre</h4>
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
                    <h4 class="card-title">Daftar Genre</h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>Kode Genre</th>
                                    <th>Nama Genre</th>
                                    <th width="30">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($genre as $row)
                                <tr>
                                    <td>{{$row->kd_genre}}</td>
                                    <td>{{$row->na_genre}}</td>
                                    <td> 
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-info edit" genreid="{{$row->no_id}}">Edit</button>
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-danger delete" genreid="{{$row->no_id}}">Hapus</button>
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
                    <h4 class="modal-title" id="myModalLabel">Tambah Genre</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Kode Genre</label>
                        <input class="form-control" type="text" id="kd_genre" placeholder="Masukkan Kode">
                    </div>
                    <div class="form-group">
                        <label for="username">Nama Genre</label>
                        <input class="form-control" type="text" id="na_genre" placeholder="Masukkan Nama">
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
                    <h4 class="modal-title" id="myModalLabel">Edit Data Genre</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Kode Genre</label>
                        <input class="form-control" type="text" id="edit_kd_genre" placeholder="Masukkan Kode">
                    </div>
                    <div class="form-group">
                        <label for="username">Nama Genre</label>
                        <input class="form-control" type="text" id="edit_na_genre" placeholder="Masukkan Nama">
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
    var kd_genre  =   $('#kd_genre').val();
    var na_genre  =   $('#na_genre').val();

    if(kd_genre != '' && na_genre != '') {
        $.ajax({
            url: '{{route("addgenre")}}',
            type: 'post',
            data: {kd_genre: kd_genre, na_genre: na_genre, _token: '{{csrf_token()}}'},
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
    var no_id  =   $(this).attr('genreid');
    $.ajax({
        url: '{{route("getgenre")}}',
        type: 'post',
        data: {no_id: no_id, _token: '{{csrf_token()}}'},
        success: function(response){
            $('#edit_kd_genre').val(response['kd_genre']);
            $('#edit_na_genre').val(response['na_genre']);
            $('#edit_id').val(response['no_id']);
            $('#edit').modal('show');
        }
    });
});

$(document).on('click', '#update', function() {
    var no_id    =   $('#edit_id').val();
    var kd_genre  =   $('#edit_kd_genre').val();
    var na_genre  =   $('#edit_na_genre').val();

    if(kd_genre != '' && na_genre != '') {
        $.ajax({
            url: '{{route("updategenre")}}',
            type: 'post',
            data: {no_id: no_id, kd_genre: kd_genre, na_genre: na_genre,  _token: '{{csrf_token()}}'},
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
    var no_id    =   $(this).attr('genreid');
    if (confirm('Apakah anda yakin menghapus data ini ?')) {
        $.ajax({
            type : 'POST',
            url  : '{{route("deletegenre")}}',
            data : {no_id: no_id, _token: '{{csrf_token()}}'},
            success : function(response) {
                window.location.reload();
            }
        });
    }
});
</script>
@endpush