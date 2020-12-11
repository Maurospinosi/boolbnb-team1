@extends('layouts.main')

@section('title')
    {{$house->houseinfo->title}}
@endsection

@section('page-content')

    {{-- Messsaggio di errore per sponsorizzazione senza € --}}
    @error('amount')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
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


    <div class="container-fluid">
        <div class="row">
     {{-- Tasti di Modifica, Cancella e Sponsorizza --}}
             @if(Auth::id() == $house->user_id)
            <nav class="col-md-2 col-lg-2  bg-light sidebar">
                <div class="sidebar-sticky host-nav-col justify-content-start">
                    <div class="nav d-flex flex-column host-nav">
                        <div class="nav-item d-inline-flex p-2 align-items-center ">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-home"></i> Bacheca 
                                <span class="sr-only">(current)</span>
                            </a>
                        </div>
                    </div>
                    <div class="nav d-flex flex-column host-nav">
                        <div class="nav-item d-inline-flex p-2 align-items-center ">
                            <a class="nav-link" href="{{route("host/house.edit", $house->id)}}">
                                <i class="far fa-edit"></i>
                                <span>Modifica</span>
                            </a>   
                        </div>
                    </div>
                    <div class="nav d-flex flex-column host-nav">
                        <div class="nav-item d-inline-flex p-2 align-items-center ">
                            <a class="nav-link">
                                <i class="far fa-trash-alt"></i>
                                <button id="open-delete-menu" class="delete-button">Cancella</button>
                                <form class="delete-menu d-none" action="{{route("host/house.destroy", $house->id)}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <h6>Cancellare la casa?</h6>
                                    @if(count($house->sponsors) != 0)
                                        <h6>Questa casa è sponsorizzata</h6>
                                    @endif
                                    <input type="submit" value="Conferma">
                                    <h6 id="button-annulla">Annulla</h6>
                                </form>
                            </a>   
                        </div>
                        @if (count($house->sponsors) == 0)
                        <div class="nav d-flex flex-column host-nav">
                            <div class="nav-item d-inline-flex p-2 align-items-center ">
                            <!-- Nav Item - Utilities Collapse Menu -->
                                <a class="nav-link"> 
                                    <i class="far fa-credit-card"></i>
                                    <span id="open-sponsor-menu">Sponsorizza</span>
                                </a>
                            </div>
                        </div>
                        <form id="host-sponsorship" class="d-none" action="{{route("host/sponsorship", $house->user_id)}}" method="GET">
                            @csrf
                            @method("GET")
                            <select class="form-control" name="amount">
                                <option value="" selected>Seleziona</option>
                                <option value="2.99">2.99€ / 24h</option>
                                <option value="5.99">5.99€ / 72h</option>
                                <option value="9.99">9.99€ / 144h</option>
                            </select>
                            <input type="hidden" name="url" value="{{Request::url()}}">
                            <input type="hidden" name="house_id" value="{{$house->id}}">
                            <input class="form-control" type="submit" value="Vai">
                        </form>
                        @endif
                        <div class="nav d-flex flex-column host-nav">
                            <div class="nav-item d-inline-flex p-2 align-items-center ">
                                <a class="nav-link" href="{{route("host/house/statistic", $house->id)}}">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Statistiche</span>
                                </a>   
                            </div>
                        </div>
                        <div class="nav d-flex flex-column host-nav">
                            <div class="nav-item d-inline-flex p-2 align-items-center ">
                                <a class="nav-link" href="{{route('host/message.index', $house->id)}}">
                                    <i class="fas fa-envelope-open-text"></i>
                                    <span>Leggi i messaggi</span>
                                </a> 
                            </div> 
                        </div>
                    </div>
                </div>
            </nav>
            @endif
        
            {{-- Print della casa --}}
            <div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 bg-white">
                <div class="d-sm-flex align-items-center justify-content-center mb-4 titolo-scheda">
                    <span>{{$house->houseinfo->title}}</span>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow  py-2">
                            <div class="card-body h-100">
                                <div class="row no-gutters justify-content-center">
                                    <div class="col mr-2 align-content-center">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1 info">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow  py-2">
                            <div class="card-body h-100">
                                <div class="row no-gutters justify-content-center">
                                    <div class="col mr-2 align-content-center">
                                        <div class="text-xs font-weight-bold info text-uppercase mb-1">
                                            Descrizione
                                        </div>
                                        <div class="h5 mb-0 font-weight-light text-gray-400">
                                            <ul class="list-unstyled">
                                                <li>{{$house->houseinfo->description}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow py-2">
                            <div class="card-body h-100">
                                <div class="row no-gutters justify-content-center">
                                    <div class="col mr-2 align-content-center">
                                        <div class="text-xs font-weight-bold info text-uppercase mb-1">
                                            I servizi di questa casa
                                        </div>
                                        <div class="h5 mb-0 font-weight-light text-gray-400">
                                            <ul class="list-unstyled">
                                                @foreach ($services as $service)
                                                    <li>{{$service->name}}</li>
                                                @endforeach      
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3  col-md-6 mb-4">
                        <div class="card border-left-primary shadow py-2">
                            <div class="card-body h-100">
                                <div class="row no-gutters justify-content-center">
                                    <div class="col  align-content-center">
                                        <div id="map-example-container"></div>
                                    </div>
                                </div>
                                <div class="coordinate-container">
                                    <input class="latitudine" type="hidden"  value="{{$house->houseinfo->lat}}">
                                    <input class="longitudine" type="hidden"   value="{{$house->houseinfo->lon}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex p-2 justify-content-center titolo-image">
                    <span>Le immagini che hai scelto</span> 
                </div>
                <div class="row image">
                    <div class="column ">
                        @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                            <img class="item" style="width:100%" src="{{$house->houseinfo->cover_image}}" alt="Thumbnail [100%x225]" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                        @else
                            <img class="item" style="width:100%" src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="Thumbnail [100%x225]" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                        @endif
                    </div>
                     @foreach ($images as $image)
                     <div class="column ">
                            @if (strpos($image->url, 'http') === 0)
                                <img class="item" style="width:100%" src="{{$image->url}}" alt="Thumbnail [100%x225]" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                            @else
                                <img class="item" style="width:100%" src="{{asset('storage/'.$image->url)}}" alt="Thumbnail [100%x225]" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                             @endif 
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>

    </div>
 
    </div>

@endsection