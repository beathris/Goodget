<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('/assets/library/bootstrap-4.4.1/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('/assets/library/highcharts-8.0.4/code/css/highcharts.css')}}">
    <link rel="stylesheet" href="{{url('/assets/style.css')}}">
</head>

<body>
<div class="col-md-12 mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Laporan Pendapatan</h2>
            <div class="card-body">
                <div id="grafik-pendapatan" style="height: 400px;"></div>
            </div>
        </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/assets/library/highcharts-8.0.4/code/highcharts.js"></script>
<script src="/assets/app.js"></script>
</html>