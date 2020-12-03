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
        
        <div class="mt-10"> 
            <h1 >{{$house->houseinfo->title}}</h1>
        </div>
        
        
        <div class="d-inline-flex p-2 bd-highlight">
                <span>{{$house->houseinfo->price}}€ a notte</span>
        </div>
        <div class="d-inline-flex p-2 bd-highlight">
            <h6>Tag: </h6>
        </div>
        <div class="d-inline-flex p-2 bd-highlight">
            <ul class="list-inline">
                @foreach ($houseTags as $houseTag)
                    <li class="list-inline-item">{{$houseTag}}</li>
                @endforeach
            </ul>
        </div>
        <div class="d-inline-flex p-2 bd-highlight">
            <ul class="list-inline list-unstyled">
                <li class="list-inline-item">Città: {{$house->houseinfo->city}}</li>
                <li class="list-inline-item">Paese: {{$house->houseinfo->country}}</li>
            </ul>
        </div>
      
        <div class="d-flex p-2 bd-highlight" id="cover-image">
            @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                <img class="img-fluid" src="{{$house->houseinfo->cover_image}}" alt="random picture">
            @else
                <img src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
            @endif
        </div>
       

        <div style="display: flex; flex-direction: row; flex-wrap: wrap; " id="other-images">
        @foreach ($images as $image)
            @if (strpos($image->url, 'http') === 0)
                <img class="img-thumbnail" src="{{$image->url}}" alt="random picture">
            @else
                <img src="{{asset('storage/'.$image->url)}}" alt="">
            @endif
            @endforeach
        </div>

        <div class="d-flex flex-column  bd-highlight mb-3">
            <div class="d-flex justify-content-center p-2 bd-highlight">
    
                <ul class="list-inline list-unstyled">
                    <li class="list-inline-item"><i class="fas fa-bed"></i></li>
                    <li class="list-inline-item">Stanze: {{$house->houseinfo->rooms}}</li>
                    <li class="list-inline-item"><i class="fas fa-user"></i></li>
                    <li class="list-inline-item">Letti: {{$house->houseinfo->beds}}</li>
                    <li class="list-inline-item"><i class="fas fa-bath"></i></li>
                    <li class="list-inline-item">Bagni: {{$house->houseinfo->bathrooms}}</li>
                    <li class="list-inline-item"><i class="fas fa-ruler-combined"></i></li>
                    <li class="list-inline-item">Metri quadri: {{$house->houseinfo->mq}}</li>
                </ul>
            </div>
        </div>
        <div class="d-flex flex-column bd-highlight mb-3">
            <div class="p-2 bd-highlight">
                <h6>Servizi</h6>
                <ul class="list-inline list-unstyled">
            
                     @foreach ($houseServices as $houseService)
                        <li>{{$houseService}}</li>
                    @endforeach      
                </ul>
            </div>
        </div>

        <div class="form w-100">
            <h2 class="text-center">Invia un messaggio</h2>
            <form class="ml-1 p-3 w-100">
                <div class="form-group">
                  <label for="exampleFormControlInput1">Email</label>
                  <input type="email" class="form-control w-100" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Name</label>
                    <input type="name" class="form-control w-100" id="name" placeholder="inserisci il tuo nome">
                  </div>
               
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Example textarea</label>
                  <textarea class="form-control w-100" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button class="btn btn-primary">Invia</button>
            </form>
        </div>

    </div>
@endsection