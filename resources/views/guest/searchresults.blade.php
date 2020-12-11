@extends('layouts.main')

@section('title')
    Risultati
@endsection
@section('page-content')
<div class="container" id="searchresults-wrapper">

    {{-- Form di ricerca avanzata --}}
    <div class="row"> 
        <form id="searchresults-form">
            <h4 id="searchresults-title">Ricerca avanzata</h4>
            <div id="searchresults-services">
                <ul>
                    @foreach ($services as $service) 
                        <li>
                            <label for="{{$service->name}}">{{$service->name}}</label>
                            <input value="{{$service->id}}" name="{{$service->name}}" id="{{$service->id}}" type="checkbox">
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="searchresults-tags">
                <ul>
                    <li>  
                         <label for="rooms">Stanze</label>
                         <input name="rooms" id="rooms" type="number" min="0">         
                    </li>
                    <li>
                        <label for="beds">Letti</label>
                        <input name="beds" id="beds" type="number" min="1">
                    </li>
                    <li>
                        <label for="bathrooms">Bagni</label>
                        <input name="bathrooms" id="bathrooms" type="number" min="0">
                    </li>
                    <li>
                        <label for="mq">Metri quadri</label>
                        <input name="mq" id="mq" type="number" min="10">
                    </li>
                    <li>
                        <label for="price-searchresults">Prezzo</label>
                        <input name="price" id="price-searchresults" type="number" min="5">
                    </li>
                    <li>
                        <label for="distance">Distanza</label>                    
                        <input type="range" name="distance" id="distance" value="20" min="2" max="40" step="2" oninput="this.nextElementSibling.value = this.value" style="vertical-align: middle">
                        <output>20</output>
                    </li>
                </ul>
            </div>
        </form>
    </div>

    {{-- Nr case trovate --}}
    @if($nrHouses == 0)
        <h4 class="nrResults">Nessuna casa trovata</h4>
    @else
        <h4 class="nrResults">Case trovate: <span>{{$nrHouses}}</span></h4>
    @endif

    {{-- Mappa --}}
    <div class="big-map" id="map-example-container"></div>

    {{-- Case sponsorizzate --}}
    <div class="row" id="sponsored-houses-container">
        @foreach ($sponsoredHouses as $sponsoredHouse)
            <div class="card sponsor-bg-color">
                <div class="card-body">
                    <span class="badge badge-secondary sponsorizzata">In evidenza</span>
                    <div class="card_img">
                        @if (strpos($sponsoredHouse->houseinfo->cover_image, 'http') === 0)
                        <img class="d-block w-100" src="<?php echo "https://res.cloudinary.com/dofcj4o0y/image/upload/w_300,h_200,c_thumb,q_100,f_auto/". str_replace("https://res.cloudinary.com/dofcj4o0y/image/upload/", "", "{$sponsoredHouse->houseinfo->cover_image}") ?>" alt="random picture">
                        @else
                            <img class="card-img-left" src="{{asset('storage/'.$sponsoredHouse->houseinfo->cover_image)}}" alt="cover picture">
                        @endif
                    </div>
                    <div class="card_text">
                        <h5 class="card-title">{{$sponsoredHouse->houseinfo->title}}</h5>
                        <h6>{{$sponsoredHouse->houseinfo->price}}€</h6>
                        <a href="
                                @if (Auth::id() == $sponsoredHouse->user_id)
                                    {{route("host/house.show", $sponsoredHouse->id)}}
                                @else
                                    {{route("guest/house", $sponsoredHouse->slug)}}
                                @endif">
                                <button type="button" class="btn btn-scopri">Scopri</button>
                            </a>
                    </div>
                    @if(count($sponsoredHouse->tags) > 0)
                    <div class="card_badges">
                        <i class="fas fa-tags"></i>
                            @foreach($tags as $tag)
                                @if ($sponsoredHouse->tags->contains($tag))
                                    <span class="badge badge-light">{{$tag->name}}</span>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div class="coordinate-container">
                        <input class="latitudine" type="hidden"  value="{{$sponsoredHouse->houseinfo->lat}}">
                        <input class="longitudine" type="hidden"   value="{{$sponsoredHouse->houseinfo->lon}}">
                    </div>  
                </div>
            </div>
        @endforeach
    </div>

    {{-- Risultati della ricerca --}}
    <div class="row" id="houses-container">
        @foreach ($houses_info as $house_info )
            <div class="card">
                <div class="card-body">
                    <div class="card_img">
                        @if (strpos($house_info->cover_image, 'http') === 0)
                            <img class="card-img-left" src="{{$house_info->cover_image}}" alt="cover picture">
                        @else
                            <img class="card-img-left" src="{{asset('storage/'.$house_info->cover_image)}}" alt="cover picture">
                        @endif
                    </div>
                    <div class="card_text">
                        <h5 class="card-title">{{$house_info->title}}</h5>
                        <h6>{{$house_info->price}}€</h6>
                            <a href="
                                @if (Auth::id() == $house_info->house->user_id)
                                    {{route("host/house.show", $house_info->house->id)}}
                                @else
                                    {{route("guest/house", $house_info->house->slug)}}
                                @endif">
                                <button type="button" class="btn btn-scopri">Scopri</button>
                            </a>
                    </div>
                    <div class="coordinate-container">
                        <input class="latitudine" type="hidden"  value=" {{$house_info->lat}}">
                        <input class="longitudine" type="hidden"   value=" {{$house_info->lon}}">
                    </div>  
                    @if(count($house_info->house->tags) > 0)
                    <div class="card_badges">
                        <i class="fas fa-tags"></i>
                            @foreach($tags as $tag)
                                @if ($house_info->house->tags->contains($tag))
                                    <span class="badge badge-light">{{$tag->name}}</span>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Template delle case --}}
    <div class="res-temp d-none">
        <div class="card">
            <div class="card-body">
                <span class="badge badge-secondary sponsorizzata d-none">In evidenza</span>
                <div class="card_img">
                    <img src="cover_image" alt="cover picture">
                </div>
                <div class="card_text">
                    <h5 class="card-title">titolo</h5>
                    <h6 class="card_price">price</h6>
                    <a href="http://localhost:8000/host/houseLINK">
                        <button type="button" class="btn btn-scopri">Scopri</button>
                    </a>
                </div>
                <div class="coordinate-container">
                    <input class="latitudine" type="hidden"  value="">
                    <input class="longitudine" type="hidden"   value="">
                </div>  
                {{-- Se ci sono tag --}}
                <div class="card_badges">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Template dei tag --}}
    <div class="badge-template d-none">
        <span class="badge badge-light">tag</span>
    </div>

</div>

@endsection