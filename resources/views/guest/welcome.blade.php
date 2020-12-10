@extends('layouts.main')

@section('title')
    BoolBnb
@endsection

@section('style')
<style>
    html, body {
    background-color: #fff;
    color: #636b6f;
    font-weight: 200;
    height: 100vh;
    margin: 0;
    }

    .full-height {
        height: 100px;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    .houses-container {
        display: flex;
        flex-wrap: nowrap;
    }

    .sponsorizzata {
        position: absolute;
        top: 5px;
        right: 5px;
    }
</style>
@endsection

@section('page-content')
    
{{-- Jumbotron --}}
<div class="no-wrap">
    <div class="jumbotron"></div>
</div>
{{-- fine Jumbotron --}}


<div class="container">
    <div class="row">
        @foreach($housesToPrint as $house)
            <div class="col-lg-4 col-md-6 mb-4">
    
                <div class="card h-100">
                    @if (count($house->sponsors) > 0)
                        <span class="badge badge-secondary sponsorizzata">In evidenza</span>
                    @endif
                    @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                        <img class="card-img-top" src="{{$house->houseinfo->cover_image}}" alt="random picture">
                     @else
                        <img class="card-img-top" src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
                    @endif    
    
                    <div class="card-body">
                        <h4 class="card-title titolo">{{$house->houseinfo->title}}</h4>
                    </div>
                    <div class="card-footer d-flex justify-content-center ">
                        <button type="button" class="btn btn-scopri">
                            <a href="
                                @if (Auth::id() == $house->user_id)
                                {{route("host/house.show", $house->id)}}
                                @else
                                {{route("guest/house", $house->slug)}}
                                @endif">Scopri</a></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

