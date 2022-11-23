@extends('layouts.layout')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Buku</h4>
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
                    <h4 class="card-title">Daftar Buku</h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>Kode Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Genre</th>
                                    <th width="30">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($buku as $row)
                                <tr>
                                    <td>{{$row->kd_buku}}</td>
                                    <td>{{$row->na_buku}}</td>
                                    @if($row->role == 'Admin')
                                        <td><span class="badge badge-danger ml-auto">{{$row->genre}}</span></td>
                                    @else
                                    <td><span class="badge badge-info ml-auto">{{$row->genre}}</span></td>
                                    @endif
                                    <td> 
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-info edit" bukuid="{{$row->no_id}}">Edit</button>
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-danger delete" bukuid="{{$row->no_id}}">Hapus</button>
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
                    <h4 class="modal-title" id="myModalLabel">Tambah Buku</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Kode Buku</label>
                        <input class="form-control" type="text" id="kd_buku" placeholder="Masukkan Kode Buku">
                    </div>
                    <div class="form-group">
                        <label for="username">Nama Buku</label>
                        <input class="form-control" type="text" id="na_buku" placeholder="Masukkan Judul Buku">
                    </div>
                    <div class="form-group">
                        <label for="username">Genre</label>
                        <!-- <input class="form-control" type="text" id="genre" placeholder="Masukkan Genre Buku"> -->
                        <select class="form-control" id="genre">
                            <option value=""> pilih genre </option>
                            @foreach($genre as $row)
                            <option value="{{$row->na_genre}}">{{$row->na_genre}}</option>
                            @endforeach
                        </select>
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
                    <h4 class="modal-title" id="myModalLabel">Edit Data Buku</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Kode Buku</label>
                        <input class="form-control" type="email" id="edit_kd_buku" placeholder="Masukkan Kode Buku" readonly>
                    </div>
                    <div class="form-group">
                        <label for="username">Judul Buku</label>
                        <input class="form-control" type="text" id="edit_na_buku" placeholder="Masukkan Judul Buku">
                    </div>
                    <div class="form-group">
                        <label for="username">Genre</label>
                        <select class="form-control" id="edit_genre">
                            <option value=""> pilih genre </option>
                            @foreach($genre as $row)
                            <option value="{{$row->na_genre}}">{{$row->na_genre}}</option>
                            @endforeach
                        </select>
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
    var kd_buku  =   $('#kd_buku').val();
    var na_buku  =   $('#na_buku').val();
    var genre    =   $('#genre').val();
    console.log(kd_buku, na_buku, genre);

    if(kd_buku != '' && na_buku != '' && genre != '') {
        $.ajax({
            url: '{{route("addbuku")}}',
            type: 'post',
            data: {kd_buku: kd_buku, na_buku: na_buku, genre: genre, _token: '{{csrf_token()}}'},
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
    var no_id  =   $(this).attr('bukuid');
    $.ajax({
        url: '{{route("getbuku")}}',
        type: 'post',
        data: {no_id: no_id, _token: '{{csrf_token()}}'},
        success: function(response){
            $('#edit_kd_buku').val(response['kd_buku']);
            $('#edit_na_buku').val(response['na_buku']);
            $('#edit_genre').val(response['genre']);
            $('#edit_id').val(response['no_id']);
            $('#edit').modal('show');
        }
    });
});

$(document).on('click', '#update', function() {
    var no_id    =   $('#edit_id').val();
    var kd_buku  =   $('#edit_kd_buku').val();
    var na_buku  =   $('#edit_na_buku').val();
    var genre    =   $('#edit_genre').val();

    if(kd_buku != '' && na_buku != '' && genre != '') {
        $.ajax({
            url: '{{route("updatebuku")}}',
            type: 'post',
            data: {no_id: no_id, kd_buku: kd_buku, na_buku: na_buku, genre: genre,  _token: '{{csrf_token()}}'},
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
    var no_id    =   $(this).attr('bukuid');
    if (confirm('Apakah anda yakin menghapus data ini ?')) {
        $.ajax({
            type : 'POST',
            url  : '{{route("deletebuku")}}',
            data : {no_id: no_id, _token: '{{csrf_token()}}'},
            success : function(response) {
                window.location.reload();
            }
        });
    }
});
</script>
@endpush