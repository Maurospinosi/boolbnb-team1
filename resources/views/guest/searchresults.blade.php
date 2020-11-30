@extends('layouts.main')

@section('title')
    Risultati
@endsection


@section('page-content')
    
    <div class="container">

        <form id="search-results-form">
            <div>
                <ul>
                    @foreach ($services as $service) 
                        <li>
                            <label for="{{$service->name}}">{{$service->name}}</label>
                            <input value="{{$service->id}}" name="{{$service->name}}" id="{{$service->id}}" type="checkbox">
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <ul>
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
                </ul>
            </div>
        </form>

        @foreach ($houses_info as $houseinfo)
        <div class="card" style="width: 18rem;">
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

@endsection