@extends('layouts.main')

@section('page-content')

<style>

    .container {
        margin-top: 150px;
    }

    canvas {
        margin: 20px;
    }
</style>
 
    <div data-stat="{{$id}}" id="statistic-container" class="container">
        <h2>Statistiche</h2>

        <canvas style="display: inline-block; max-width: 500px; max-height: 600px" id="myChart"></canvas>
        <canvas style="display: inline-block; max-width: 500px; max-height: 600px" id="myChart2"></canvas>

        <canvas style="display: inline-block; max-width: 500px; max-height: 600px" id="myChart_bar"></canvas>
        <canvas style="display: inline-block; max-width: 500px; max-height: 600px" id="myChart2_bar"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="{{asset("js/statistic.js")}}"></script>

@endsection