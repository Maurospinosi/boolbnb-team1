@extends('layouts.main')

@section('title')
    {{$house->houseinfo->title}}
@endsection

@section('page-content')

    <div class="container"> 
        <h1>{{$house->houseinfo->title}}</h1>
        <span>{{$house->houseinfo->price}}</span>
        <div id="cover-image">
            <img src="{{asset('storage/'. $house->houseinfo->cover_image)}}" alt="immagine non trovata">
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
        </ul>

        {{-- @dd($house->houseinfo) --}}
        {{-- @dd($info); --}}

        @foreach ($house->houseinfo->images as $image)
        <div id="other-images">
            <img src="{{asset('storage/'. $image->url)}}" alt="immagine non trovata">
        </div>
        @endforeach

    <form action=" {{route("host/house.destroy", $house->id)}}" method="post">
        @csrf
        @method("DELETE")

            <button class="btn btn-primary">Cancella</button>
        </form>

    </div>
@endsection