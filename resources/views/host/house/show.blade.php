@extends('layouts.main')

@section('title')
    {{$house->houseinfo->title}}
@endsection

@section('page-content')


    <div class="container host-show-container"> 
        {{-- <div id="dropin-container"></div> --}}
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


        @if (session()->has('success'))
            <div class="alert alert-success">
                @if(is_array(session('success')))
                    <ul>
                        @foreach (session('success') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @else
                    {{ session('success') }}
                @endif
            </div>
        @endif

        <h1>{{$house->houseinfo->title}}</h1>
        <span>{{$house->houseinfo->price}}€ a notte</span>
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
            {{-- <li>
                <h6>Servizi</h6>
                <ul>
                    @foreach ($services as $service)
                        
                    @endforeach
                </ul>
            </li> --}}
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