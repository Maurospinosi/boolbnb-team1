@extends('layouts.main')

@section('title')
    BoolBnb
@endsection

@section('style')
<style>
    html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Nunito', sans-serif;
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
        flex-wrap: wrap;
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

<div class="houses-container">
    @foreach($sponsoredHouses as $house)
        <div class="card" style="width: 18rem;">
            <span class="badge badge-secondary sponsorizzata">In evidenza</span>

            @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                <img src="{{$house->houseinfo->cover_image}}" alt="random picture">
            @else
                <img src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
            @endif    
                
            <div class="card-body">
                <h5 class="card-title">{{$house->houseinfo->title}}</h5>
                <a href="
                @if (Auth::id() == $house->user_id)
                {{route("host/house.show", $house->id)}}
                @else
                {{route("guest/house", $house->slug)}}
                @endif
                " class="btn btn-warning">Show</a>
            </div>
    </div>
    @endforeach
</div>

@endsection

