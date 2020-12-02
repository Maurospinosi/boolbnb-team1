@extends('layouts.main')

@section('title')
    {{$house->houseinfo->title}}
@endsection

@section('page-content')

    <div class="container guest-show-container"> 
        <a href="{{route('guest/home')}}" class="btn btn-info">Torna alla Home</a>
        <a href="{{route('guest/search')}}" class="btn btn-info">Torna alla ricerca</a>

        @if(Auth::id() == $house->user_id)
            <div class="auth-buttons">
                <a href="{{route("host/house.edit", $house->id)}}" class="btn btn-primary">Modifica</a>
                <form action=" {{route("host/house.destroy", $house->id)}}" method="post">
                    @csrf
                    @method("DELETE")
                        <button class="btn btn-danger">Cancella</button>
                </form>
            </div>
        @endif

        <h1>{{$house->houseinfo->title}}</h1>
        <span>{{$house->houseinfo->price}}€ a notte</span>
        <h6>Tag: </h6>
        <ul>
            @foreach ($houseTags as $houseTag)
                <li>{{$houseTag}}</li>
            @endforeach
        </ul>
        <div id="cover-image">
            @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                <img src="{{$house->houseinfo->cover_image}}" alt="random picture">
            @else
                <img src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
            @endif
        </div>
        <ul>
            <li>Stanze: {{$house->houseinfo->rooms}}</li>
            <li>Letti: {{$house->houseinfo->beds}}</li>
            <li>Bagni: {{$house->houseinfo->bathrooms}}</li>
            <li>Metri quadri: {{$house->houseinfo->mq}}</li>
            <li>Stanze: {{$house->houseinfo->rooms}}</li>
            <li>Città: {{$house->houseinfo->city}}</li>
            <li>Paese: {{$house->houseinfo->country}}</li>
            <li>{{$house->houseinfo->description}}</li>
            <li>
                <h6>Servizi</h6>
                <ul>
                    @foreach ($houseServices as $houseService)
                        <li>{{$houseService}}</li>
                    @endforeach
                </ul>
            </li>
        </ul>

        <div style="display: flex; flex-direction: row; flex-wrap: wrap; " id="other-images">
        @foreach ($images as $image)
            @if (strpos($image->url, 'http') === 0)
                <img src="{{$image->url}}" alt="random picture">
            @else
                <img src="{{asset('storage/'.$image->url)}}" alt="">
            @endif
            @endforeach
        </div>

    </div>
@endsection