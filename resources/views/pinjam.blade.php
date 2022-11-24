@extends('layouts.layout')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Peminjaman Buku</h4>
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
                    <h4 class="card-title">Daftar Transaksi</h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No Bukti</th>
                                    <th>Kode Member</th>
                                    <th>Nama Member</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Keterangan</th>
                                    <th>Nama Buku</th>
                                    <th width="30">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pinjam as $row)
                                <tr>
                                    <td>{{$row->no_bukti}}</td>
                                    <td>{{$row->kd_member}}</td>
                                    <td>{{$row->na_member}}</td>
                                    <td>{{$row->tgl}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td>{{$row->na_buku}}</td>
                                    <td> 
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-info edit" pinjamid="{{$row->no_id}}">Edit</button>
                                        <button type="button" class="btn waves-effect waves-light btn-sm btn-danger delete" pinjamid="{{$row->no_id}}">Hapus</button>
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
                    <h4 class="modal-title" id="myModalLabel">Tambah Transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">No Bukti</label>
                        <input class="form-control" type="text" id="no_bukti" placeholder="Masukkan No Bukti">
                    </div>
                    <!-- <div class="form-group">
                        <label for="username">Kode Member</label>
                        <select class="form-control" name="kd_member" id="kd_member">
                            <option value=""> pilih user </option>
                            @foreach($member as $row)
                            <option value="{{$row->no_id}}">{{$row->kd_member}}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label for="username">Nama Member</label>
                        <select class="form-control" name="na_member" id="na_member">
                            <option value=""> pilih user </option>
                            @foreach($member as $row)
                            <option value="{{$row->na_member}}">{{$row->na_member}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Keterangan</label>
                        <input class="form-control" type="text" id="keterangan" placeholder="Masukkan Keterangan">
                    </div>
                    <div class="form-group">
                        <label for="username">Judul Buku</label>
                        <select class="form-control" name="id_buku" id="id_buku">
                            <option value=""> pilih buku </option>
                            @foreach($buku as $row)
                            <option value="{{$row->no_id}}">{{$row->na_buku}}</option>
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
                    <h4 class="modal-title" id="myModalLabel">Edit Data Transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">No Bukti</label>
                        <input class="form-control" type="text" id="edit_no_bukti" placeholder="Masukkan No Bukti">
                    </div>
                    <!-- <div class="form-group">
                        <label for="username">Kode Member</label>
                        <select class="form-control" name="kd_member" id="edit_kd_member">
                            <option value=""> pilih member </option>
                            @foreach($member as $row)
                            <option value="{{$row->kd_member}}">{{$row->kd_member}}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label for="username">Nama Member</label>
                        <select class="form-control" name="na_member" id="edit_na_member">
                            <option value=""> pilih member </option>
                            @foreach($member as $row)
                            <option value="{{$row->na_member}}">{{$row->na_member}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Keterangan</label>
                        <input class="form-control" type="text" id="edit_keterangan" placeholder="Masukkan Keterangan">
                    </div>
                    <div class="form-group">
                        <label for="username">Judul Buku</label>
                        <select class="form-control" id="edit_buku_id">
                            <option value=""> pilih buku </option>
                            @foreach($buku as $row)
                            <option value="{{$row->no_id}}">{{$row->na_buku}}</option>
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
    var no_bukti     =   $('#no_bukti').val();
    var na_member    =   $('#na_member').val();
    var keterangan   =   $('#keterangan').val();
    var id_buku      =   $('#id_buku').val();
    console.log(no_bukti, na_member, keterangan, id_buku);

    if(no_bukti != '' && na_member != '' && keterangan != '' && id_buku != '') {
        $.ajax({
            url: '{{route("addpinjam")}}',
            type: 'post',
            data: {no_bukti: no_bukti, na_member: na_member, keterangan: keterangan, id_buku: id_buku, _token: '{{csrf_token()}}'},
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
    var no_id  =   $(this).attr('pinjamid');
    $.ajax({
        url: '{{route("getpinjam")}}',
        type: 'post',
        data: {no_id: no_id, _token: '{{csrf_token()}}'},
        success: function(response){
            $('#edit_no_bukti').val(response['no_bukti']);
            $('#edit_na_peg').val(response['na_peg']);
            $('#edit_devisi').val(response['devisi']);
            $('#edit_tgl').val(response['tgl']);
            $('#edit_ket').val(response['ket']);
            $('#edit_buku_id').val(response['buku_id']);
            $('#edit_id').val(response['no_id']);
            $('#edit').modal('show');
        }
    });
});

$(document).on('click', '#update', function() {
    var no_id     =   $('#edit_id').val();
    var no_bukti  =   $('#edit_no_bukti').val();
    var na_peg    =   $('#edit_na_peg').val();
    var devisi    =   $('#edit_devisi').val();
    var tgl       =   $('#edit_tgl').val();
    var ket       =   $('#edit_ket').val();
    var buku_id   =   $('#edit_buku_id').val();

    if(no_bukti != '' && na_peg != '' && devisi != '' && tgl != ''  && ket != ''&& buku_id != '') {
        $.ajax({
            url: '{{route("updatepinjam")}}',
            type: 'post',
            data: {no_id: no_id, no_bukti: no_bukti, na_peg: na_peg, devisi: devisi, tgl: tgl, ket: ket, buku_id: buku_id,  _token: '{{csrf_token()}}'},
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
    var no_id    =   $(this).attr('pinjamid');
    if (confirm('Apakah anda yakin menghapus data ini ?')) {
        $.ajax({
            type : 'POST',
            url  : '{{route("deletepinjam")}}',
            data : {no_id: no_id, _token: '{{csrf_token()}}'},
            success : function(response) {
                window.location.reload();
            }
        });
    }
});
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#btnExportExcel").on("click", function() {
            var table = $('#example').DataTable();
            table.button('.buttons-excel').trigger();
        });
    });
</script>

@endpush