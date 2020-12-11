@extends('layouts.main')

@section('title')
    {{$house->houseinfo->title}}
@endsection

@section('page-content')

   
    <div class="container guest-show-container"> 
        <div class="row">
            <div class="col-md-12 col-lg-12 pt-3 px-4 bg-white">
                <div class="d-sm-flex align-items-center justify-content-center mb-4 titolo-scheda">
                    <h1 class="mt-10 titolo">{{$house->houseinfo->title}}</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-12  bg-white">
                <div class="d-flex p-2 align-content-start justify-content-end">
             
                <a href="{{route('host/house.index')}}" class="btn btn-info">Indietro</a>
            </div>
        </div>

        {{-- <div id="carouselExampleSlidesOnly" class="carousel slide cover-image" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                    <img class="d-block w-100" src="<?php echo "https://res.cloudinary.com/dofcj4o0y/image/upload/w_400,h_300,c_thumb,q_100,f_auto/". str_replace("https://res.cloudinary.com/dofcj4o0y/image/upload/", "", "{$house->houseinfo->cover_image}") ?>" alt="random picture">
                    @else
                        <img class="d-block w-100" src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
                     @endif --}}
        
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                            <img class="d-block w-100 h-75" src="<?php echo "https://res.cloudinary.com/dofcj4o0y/image/upload/w_auto,c_scale,q_auto,f_auto/". str_replace("https://res.cloudinary.com/dofcj4o0y/image/upload/", "", "{$house->houseinfo->cover_image}") ?>" alt="First slide">
                        @else
                            <img class="d-block w-100 h-75" src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
                        @endif
                    </div>
                    
                    @foreach ($images as $image)
                    <div class="carousel-item">
                        @if (strpos($image->url, 'http') === 0)
                            <img class="d-block w-100 h-75" src="{{$image->url}}" alt="Second Slide">
                        @else
                            <img class="d-block w-100 h-75"  src="{{asset('storage/'.$image->url)}}" alt="">
                        @endif
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

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
            <div class="col-md-12">
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
        

        <div class="row ">
            <div class="col-md-6 col-lg-6">
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
            <div class="col-md-6">
                <div id="map-example-container"></div>
                    <input type="search" id="input-map" class="form-control"/>
                    <input id="latitudine" type="hidden"  value=" {{$house->houseinfo->lat}}">
                    <input id="longitudine" type="hidden"   value=" {{$house->houseinfo->lon}}">
                    <input id="indirizzo" type="hidden"   value=" {{$house->houseinfo->address}}">
                </div>
            </div>
        </div>

    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>
@endsection