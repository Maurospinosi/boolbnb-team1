@extends('layouts.main')

@section('title')
    {{$house->houseinfo->title}}
@endsection

@section('page-content')

    {{-- Messsaggio di errore per sponsorizzazione senza € --}}
    @error('amount')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror   

    <div class="container-fluid">
        <div class="row">
     {{-- Tasti di Modifica, Cancella e Sponsorizza --}}
             @if(Auth::id() == $house->user_id)
            <nav class="col-md-2 d-flex flex-column d-md-block bg-light sidebar">
                <div class="sidebar-sticky host-nav-col">
                    <ul class="nav flex-column host-nav">
                        <li class="nav-item d-inline-flex justify-content-start">
                            <a class="nav-link active" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Bacheca <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item d-inline-flex justify-content-start">
                            <a class="nav-link" href="{{route("host/house.edit", $house->id)}}">
                                <i class="far fa-edit"></i>
                                <span>Modifica</span>
                            </a>   
                        </li>
                        <li class="nav-item d-inline-flex justify-content-start">
                            <a class="nav-link">
                                
                                <form action="{{route("host/house.destroy", $house->id)}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                </form><i class="far fa-trash-alt"></i>
                                <span>Cancella</span>
                            </a>   
                        </li>
                          <!-- Nav Item - Utilities Collapse Menu -->
                        <li class="nav-item d-inline-flex justify-content-start">
                            <a class="nav-link"> 
                                <form id="host-sponsorship" action="{{route("host/sponsorship", $house->user_id)}}" method="GET">
                                    @csrf
                                    @method("GET")
                                    <i class="far fa-credit-card"></i>
                                    <h5 class="btn btn-light">Sponsorizza</h5>
                                    <select class="form-control d-none" name="amount">
                                        <option value="" selected>Seleziona</option>
                                        <option value="2.99">2.99€ / 24h</option>
                                        <option value="5.99">5.99€ / 72h</option>
                                        <option value="9.99">9.99€ / 144h</option>
                                    </select>
                                    <input type="hidden" name="url" value="{{Request::url()}}">
                                    <input class="form-control d-none" type="submit" value="Vai">
                                </form>

                            </a>
                        </li>
                        
                        <li class="nav-item d-inline-flex justify-content-start">
                            <a class="nav-link" href="{{route("host/house/statistic", $house->id)}}">
                                <i class="fas fa-chart-line"></i>
                                <span>Statistiche</span>
                            </a>   
                        </li>
                        <li class="nav-item d-inline-flex justify-content-start">
                            <a class="nav-link" href="{{route('host/message.index', $house->id)}}">
                                <i class="fas fa-envelope-open-text"></i>
                                <span>Leggi i messaggi</span>
                            </a> 
                        </li> 
                    </ul>
                </div>
            </nav>
            @endif
            {{-- Messaggio di successo alla modifica della casa --}}
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
        
            {{-- Print della casa --}}
            <div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 bg-white">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{$house->houseinfo->title}}</h1>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Info
                                        </div>
                                        <div class="h5 mb-0 font-weight-light text-gray-400">
                                            <ul class="list-unstyled">
                                                <li>Stanze: {{$house->houseinfo->rooms}}</li>
                                                <li> Posti letto:{{$house->houseinfo->beds}}</li>
                                                <li>Bagni: {{$house->houseinfo->bathrooms}}</li>
                                                <li>m<sup>2</sup> {{$house->houseinfo->mq}}</li>
                                                <li>Stanze: {{$house->houseinfo->rooms}}</li>
                                                <li>Città: {{$house->houseinfo->city}}</li>
                                                <li>Paese: {{$house->houseinfo->country}}</li>
                                            </ul>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-info text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Descrizione
                                        </div>
                                        <div class="h5 mb-0 font-weight-light text-gray-400">
                                            <ul class="list-unstyled">
                                                <li>{{$house->houseinfo->description}}</li>
                                            </ul>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-pencil-alt text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            I servizi di questa casa
                                        </div>
                                        <div class="h5 mb-0 font-weight-light text-gray-400">
                                            <ul class="list-unstyled">
                                                @foreach ($services as $service)
                                                    <li>{{$service->name}}</li>
                                                @endforeach      
                                            </ul>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3  col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                   
                                    <div class=" d-flex justify-content-center" id="map-example-container"></div>
                                    <input id="latitudine" type="hidden" value=" {{$house->houseinfo->lat}}">
                                    <input id="longitudine" type="hidden"   value=" {{$house->houseinfo->lon}}">
                                    <input id="indirizzo" type="hidden"   value=" {{$house->houseinfo->address}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="album py-5 bg-white">
            <div class="container">
               
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                                <img class="card-img-top" src="{{$house->houseinfo->cover_image}}" alt="Thumbnail [100%x225]" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                            @else
                                <img class="card-img-top"  src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="Thumbnail [100%x225]" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                            @endif
                        </div>
                    </div>
                    @foreach ($images as $image)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            @if (strpos($image->url, 'http') === 0)
                                <a href="{{$image->url}}">
                                    <img class="card-img-top" src="{{$image->url}}" alt="Thumbnail [100%x225]" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                                </a>
                            @else
                            <img class="card-img-top" src="{{asset('storage/'.$image->url)}}" alt="Thumbnail [100%x225]" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                            @endif 
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>    
            
    
        
           
        
            <script src="{{ asset('js/map.js') }}"></script>
        
    </div>

@endsection