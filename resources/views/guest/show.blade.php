@extends('layouts.main')

@section('title')
    {{$house->houseinfo->title}}
@endsection

@section('page-content')

   
    <div class="container guest-show-container"> 

        <div  class="d-flex justify-content-end"> 
            <a href="{{route('guest/home')}}" class="btn btn-info">Torna alla Home</a>
            <a href="{{route('guest/search')}}" class="btn btn-info">Torna alla ricerca</a>
        </div>
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
        
        <div class="mt-10 titolo"> 
            <h1 >{{$house->houseinfo->title}}</h1>
        </div>
        
        <div class="sottotitolo">
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
        </div>

        <div id="carouselExampleSlidesOnly" class="carousel slide cover-image" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                        <img class="d-block w-100" src="{{$house->houseinfo->cover_image}}" alt="random picture">
                    @else
                        <img class="d-block w-100" src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
                     @endif
                </div>
            </div>
        </div>    
  
        <div class="row">
            @foreach ($images as $image)
            <div class="col-md-3">
                @if (strpos($image->url, 'http') === 0)
                     <img class="img-thumbnail gallery" src="{{$image->url}}" alt="random picture">
                @else
                    <img class="img-fluid gallery" src="{{asset('storage/'.$image->url)}}" alt="">
                @endif
            </div>
            @endforeach
        </div> 

        <div class="row">
            <div class="col">
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
            </div>
        </div>
        <div class="row">
            <div class="col">
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
            </div>
        </div>
        

        <div class="right ">
            <div class="form-box show-sticky">
                <div class="card-body">
                    <h3>Contatta il proprietario</h3>
                    <form action="{{route('guest/message.store')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome</label>
                            <input type="name" class="form-control " name="name" value="{{(Auth::user()) ? Auth::user()->name : ''}}" required maxlength="90" {{(Auth::user()) ? "readonly='readonly'" : ''}} id="exampleInputEmail1"
                              aria-describedby="emailHelp">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control " name="email" value="{{(Auth::user()) ? Auth::user()->email : ''}}" required maxlength="90" {{(Auth::user()) ? "readonly='readonly'" : ''}} id="exampleInputEmail1"
                              aria-describedby="emailHelp">
                            <label for="message">Messaggio</label>
                            <textarea class="form-control" name="message" required minlength="10" maxlength="700" id="message" cols="30" rows="10"></textarea>
                        </div>
                        <input type="hidden" name="house_id" value="{{$house->id}}">
                        <button class="form__btn " type="submit">Invia</button>
                    </form>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="map-example-container"></div>
    <input type="search" id="input-map" class="form-control"/>
    <input id="latitudine" type="hidden"  value=" {{$house->houseinfo->lat}}">
    <input id="longitudine" type="hidden"   value=" {{$house->houseinfo->lon}}">
    <input id="indirizzo" type="hidden"   value=" {{$house->houseinfo->address}}">


    <script src="{{ asset('js/map.js') }}"></script>
@endsection