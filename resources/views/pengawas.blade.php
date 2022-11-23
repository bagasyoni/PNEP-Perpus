@extends('layouts.layout')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Upload Data</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- basic table -->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Jumlah Suara</label>
                        <input class="form-control" type="text" id="jumlah" placeholder="Masukkan Jumlah Pemungutan Suara">
                    </div>
                    <div class="form-group">
                        <label for="username">File Foto</label>
                        <input type="file" class="form-control-file" id="file">
                    </div>
                    <button type="button" class="btn waves-effect waves-light btn-block btn-primary" id="upload">Upload data</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).on('click', '#upload', function() {
    var jumlah  =   $('#jumlah').val();
    var file    =   document.getElementById('file');

    if(jumlah != '' && file != ''){
        var form_data = new FormData();
        form_data.append('jumlah', jumlah);
        form_data.append('file', file.files[0]);
        form_data.append('_token', '{{csrf_token()}}');
        $.ajax({
            url: "{{route('uploaddata')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (response) {
                
            }
        });
    } else {
        alert('Fill all fields');
    }
});

</script>
@endpush