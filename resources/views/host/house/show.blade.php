@extends('layouts.main')

@section('title')
    {{$house->houseinfo->title}}
@endsection

@section('page-content')

    {{-- Messsaggio di errore per sponsorizzazione senza € --}}
    @error('amount')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror        

    <div class="container host-show-container">

        {{-- Tasti di Modifica, Cancella e Sponsorizza --}}
        @if(Auth::id() == $house->user_id)
        
        <div class="auth-buttons">
                <ul>
                    <li>
                        <a href="{{route("host/house.edit", $house->id)}}" class="btn btn-primary">Modifica</a>
                    </li>
                    <li>
                        <form id="host-sponsorship" action="{{route("host/sponsorship", $house->user_id)}}" method="GET">
                            @csrf
                            @method("GET")
                            <h5 class="btn btn-warning">Sponsorizza</h5>
                            <select class="form-control d-none" name="amount">
                                <option value="" selected>Seleziona</option>
                                <option value="2.99">2.99€ / 24h</option>
                                <option value="5.99">5.99€ / 72h</option>
                                <option value="9.99">9.99€ / 144h</option>
                            </select>
                            <input type="hidden" name="url" value="{{Request::url()}}">
                            <input class="form-control d-none" type="submit" value="Vai">
                        </form>
                    </li>
                    <li>
                        <form action="{{route("host/house.destroy", $house->id)}}" method="post">
                            @csrf
                            @method("DELETE")
                                <button class="btn btn-danger">Cancella</button>
                        </form>
                    </li>
                </ul>
            </div>
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
        <h1>{{$house->houseinfo->title}}</h1>
        {{-- <span>{{$house->houseinfo->price}}€ a notte</span> --}}
        <div class="row">

            <div class="d-flex">
                <div id="cover-image">
                    @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                        <img src="{{$house->houseinfo->cover_image}}" class="img-fluid" alt="Responsive image">
                        
                    @else
                        <img src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
                    @endif
                </div>
            </div>    
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div id="mdb-lightbox-ui"></div>
                    <div class="mdb-lightbox no-margin">
                        @foreach ($images as $image)
                        <figure class="col-md-4">
                            @if (strpos($image->url, 'http') === 0)
                                <a href="{{$image->url}}" data-size="1600x1067">
                                    <img src="{{$image->url}}" alt="random picture" class="img-fluid" >
                                </a>
                            @else
                                <img src="{{asset('storage/'.$image->url)}}" class="img-fluid"  alt="">
                            @endif
                        </figure>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    <div class="services">
        <ul class="list-unstyled">
            <li>Stanze: {{$house->houseinfo->rooms}}</li>
            <li> <i class="fas fa-bed"></i> {{$house->houseinfo->beds}}</li>
            <li>Bagni: {{$house->houseinfo->bathrooms}}</li>
            <li>m<sup>2</sup> {{$house->houseinfo->mq}}</li>
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

    </div>

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

        </div>
        <div id="map-example-container"></div>
        <input id="latitudine" type="hidden" value=" {{$house->houseinfo->lat}}">
        <input id="longitudine" type="hidden"   value=" {{$house->houseinfo->lon}}">
        <input id="indirizzo" type="hidden"   value=" {{$house->houseinfo->address}}">
        <script src="{{ asset('js/map.js') }}"></script>

    

@endsection