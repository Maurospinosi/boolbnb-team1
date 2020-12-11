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
    <div class="container">
        <div class="row">
            
            <div class="col-md-12 col-lg-12 pt-3 px-4 bg-white">
                <div class="d-sm-flex align-items-center justify-content-center mb-4 titolo-scheda">
                    <span>Le Statistiche della tua Casa nel 2020</span>
                </div>
            </div>
            <div class="col-md-12 col-lg-12  bg-white">
                <div class="d-flex p-2 align-items-center justify-content-end">
             
                <a href="{{route('host/house.show', $id)}}" class="btn btn-info">Indietro</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 pt-3 px-4 bg-white">    
                <div data-stat="{{$id}}" id="statistic-container" class=" justify-content-center align-content-start">
                      
                    <canvas style="display: inline-block; max-width: 450px; max-height: 500px" id="myChart"></canvas>
                    <canvas style="display: inline-block; max-width: 450px; max-height: 500px" id="myChart2"></canvas>

                    <canvas style="display: inline-block; max-width: 450px; max-height: 500px" id="myChart_bar"></canvas>
                    <canvas style="display: inline-block; max-width: 450px; max-height: 500px" id="myChart2_bar"></canvas>
                </div>
                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="{{asset("js/statistic.js")}}"></script>

@endsection