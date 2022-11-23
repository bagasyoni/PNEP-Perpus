@extends('layouts.layout')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Diagram Peminjaman Buku Per Bulan</h4>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0-alpha/Chart.min.js"></script>
<script>
    $(document).on('click', '.approve', function() {
        var id    =   $(this).attr('idne');
        var status  =   'Approved';
        if (confirm('Apakah anda yakin mensetujui data ini ?')) {
            $.ajax({
                type : 'POST',
                url  : '{{route("updatevoting")}}',
                data : {id: id, status: status, _token: '{{csrf_token()}}'},
                success : function(response) {
                    // window.location.reload();
                }
            });
        }
    });

    $(document).on('click', '.reject', function() {
        var id    =   $(this).attr('idne');
        var status  =   'Rejected';
        if (confirm('Apakah anda yakin menolak data ini ?')) {
            $.ajax({
                type : 'POST',
                url  : '{{route("updatevoting")}}',
                data : {id: id, status: status, _token: '{{csrf_token()}}'},
                success : function(response) {
                    // window.location.reload();
                }
            });
        }
    });
</script>
<script>
            function renderChart(data, labels) {
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'buku',
                                data: data[0],
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    callback: function (value, index, values) {
                                        return value;
                                    }
                                }
                            }]
                        },
                    }
                });
            }

            function getChartData() {
                $.ajax({
                    url: "{{ route('cek') }}",
                    success: function (result) {
                        var data = [];
                        var result     =   JSON.parse(result);

                        data.push(result['total']);
                        var labels = result['month'];
                        renderChart(data, labels);
                    },
                    error: function (err) {
                        $("#loadingMessage").html("Error");
                    }
                });
            }

            getChartData();
        </script>
@endpush