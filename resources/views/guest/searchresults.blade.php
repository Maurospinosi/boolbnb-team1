@extends('layouts.main')

@section('title')
    Risultati
@endsection
@section('page-content')
<style>
    ul {
        list-style: none;
        display: flex;
        flex-wrap: wrap;
    }

    li {
        min-width: fit-content;
        margin: 0 10px
        
    }

    img {
        max-width: 150px;
    }

    .container {
        margin-top: 150px;
    }

    #house-container {
        margin-top: 30px;
        display: flex;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }

    .info input {
        max-width: 60px;
        text-align: center;
    }

    .card {
        min-width: fit-content;
        margin: 0 20px;
        background-color: blanchedalmond
    }
</style>
    
    <div class="container">
        {{-- Form di ricerca avanzata --}}
        <form id="search-results-form">
            <div>
                <ul class="services">
                    @foreach ($services as $service) 
                        <li>
                            <label for="{{$service->name}}">{{$service->name}}</label>
                            <input value="{{$service->id}}" name="{{$service->name}}" id="{{$service->id}}" type="checkbox">
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <ul class="info">
                    <li>  
                         <label for="rooms">Stanze</label>
                         <input name="rooms" id="rooms" type="number">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                    </li>
                    <li>
                        <label for="beds">Letti</label>
                        <input name="beds" id="beds" type="number">
                    </li>
                    <li>
                        <label for="bathrooms">Bagni</label>
                        <input name="bathrooms" id="bathrooms" type="number">
                    </li>
                    <li>
                        <label for="mq">Metri quadri</label>
                        <input name="mq" id="mq" type="number">
                    </li>
                    <li>
                        <label for="price">Prezzo</label>
                        <input name="price" id="price" type="number">
                    </li>
                    <li>
                        <label for="distance">Distanza</label>                    
                        <input type="range" name="distance" id="distance" value="20" min="2" max="40" step="2" oninput="this.nextElementSibling.value = this.value" style="vertical-align: middle">
                        <output>20</output>
                    </li>
                </ul>
            </div>
        </form>
        <div class="row">
        </div>

        {{-- Case sponsorizzate --}}
        @if(count($sponsoredHouses) > 0)
            <div class="row" id="sponsored-houses-container">
                @foreach ($sponsoredHouses as $sponsoredHouse)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <span class="badge badge-secondary sponsorizzata">In evidenza</span>
                            @if (strpos($sponsoredHouse->houseinfo->cover_image, 'http') === 0)
                                <img class="card-img-top" src="{{$sponsoredHouse->houseinfo->cover_image}}" alt="cover picture">
                            @else
                                <img class="card-img-top" src="{{asset('storage/'.$sponsoredHouse->houseinfo->cover_image)}}" alt="cover picture">
                            @endif    
                            <div class="card-body">
                                <h4 class="card-title titolo">{{$sponsoredHouse->houseinfo->title}}</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center ">
                                <button type="button" class="btn btn-scopri">
                                    <a href="
                                        @if (Auth::id() == $sponsoredHouse->user_id)
                                            {{route("host/house.show", $sponsoredHouse->id)}}
                                        @else
                                            {{route("guest/house", $sponsoredHouse->slug)}}
                                        @endif">Scopri
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        {{-- Risultati della ricerca --}}
        <div class="row" id="house-container">
            @foreach ($houses_info as $house_info )
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        @if (strpos($house_info->cover_image, 'http') === 0)
                            <img class="card-img-top" src="{{$house_info->cover_image}}" alt="cover picture">
                        @else
                            <img class="card-img-top" src="{{asset('storage/'.$house_info->cover_image)}}" alt="cover picture">
                        @endif    
                        <div class="card-body">
                            <h4 class="card-title titolo">{{$house_info->title}}</h4>
                        </div>
                        <div class="card-footer d-flex justify-content-center ">
                            <button type="button" class="btn btn-scopri">
                                <a href="
                                    @if (Auth::id() == $house_info->house->user_id)
                                        {{route("host/house.show", $house_info->house_id)}}
                                    @else
                                        {{route("guest/house", $house_info->house->slug)}}
                                    @endif">Scopri
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    {{-- Template per stampare le case --}}
    <script id="house-template" type="text/x-handlebars-template">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                @if (strpos($house_info->cover_image, 'http') === 0)
                    <img class="card-img-top" src="{{$house_info->cover_image}}" alt="cover picture">
                @else
                    <img class="card-img-top" src="{{asset('storage/'.$house_info->cover_image)}}" alt="cover picture">
                @endif    
                <div class="card-body">
                    <h4 class="card-title titolo">{{$house_info->title}}</h4>
                </div>
                <div class="card-footer d-flex justify-content-center ">
                    <button type="button" class="btn btn-scopri">
                        <a href="
                            @if (Auth::id() == $house_info->house->user_id)
                                {{route("host/house.show", $house_info->house_id)}}
                            @else
                                {{route("guest/house", $house_info->house->slug)}}
                            @endif">Scopri
                        </a>
                    </button>
                </div>
            </div>
        </div>
</script>
    @endsection
    <html>
        
        {{-- <div class="card" style="width: 18rem;"> 
            
            <img src="@{{cover_image}}" alt="">
            <div class="card-body">
                <h5 class="card-title">@{{title}}</h5>
                <a href="http://localhost:8000/house/@{{slug}}" class="btn btn-warning">Show</a>
            </div>
        </div> --}}
    </html>