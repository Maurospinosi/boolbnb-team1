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


        <div id="house-container">

            @foreach ($houses_info as $houseinfo)
                <div class="card">
                    {{-- Badge per casa sponsorizzata --}}
                    @if (in_array($houseinfo->house_id, $sponsoredHouses))   
                        <span class="badge badge-secondary sponsorizzata">Sponsorizzata</span>
                    @endif
                    {{-- / badge --}}

                    @if (strpos($houseinfo->cover_image, 'http') === 0)
                        <img src="{{$houseinfo->cover_image}}" alt="random picture">
                    @else
                        <img src="{{asset('storage/'.$houseinfo->cover_image)}}" alt="">
                    @endif    
                        
                    <div class="card-body">
                        <h5 class="card-title">{{$houseinfo->title}}</h5>
                        <a href="{{route("guest/house", $houseinfo->house->slug)}}" class="btn btn-warning">Show</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


    <script id="house-template" type="text/x-handlebars-template">
        <div class="card" style="width: 18rem;"> 
            
            <img src="@{{cover_image}}" alt="">
            <div class="card-body">
                <h5 class="card-title">@{{title}}</h5>
                <a href="http://localhost:8000/house/@{{slug}}" class="btn btn-warning">Show</a>

            </div>
        </div>
      </script>

@endsection