@extends('layouts.main')

@section('title')
    Risultati
@endsection


@section('page-content')
    
    <div class="container">

    <form action="{{route('api.create')}}" method="POST">
        @csrf
        @method("POST")
            <div>
                <ul>
                    @foreach ($services as $service) 
                        <li>
                            <label for="{{$service->name}}">{{$service->name}}</label>
                            <input name="{{$service->name}}" id="{{$service->name}}" type="checkbox">
                        </li>
                    @endforeach

                    @foreach ($tags as $tag)
                    <li>
                        <label for="{{$tag->name}}">{{$tag->name}}</label>
                        <input name="{{$tag->name}}" id="{{$tag->name}}" type="checkbox">
                    </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <ul>
                    <li>  
                         <label for="rooms">Rooms</label>
                         <input name="rooms" id="rooms" type="number">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                    </li>
                    <li>
                        <label for="beds">Beds</label>
                        <input name="beds" id="beds" type="number">
                    </li>
                    <li>
                        <label for="bathrooms">Bathrooms</label>
                        <input name="bathrooms" id="bathrooms" type="number">
                    </li>
                    <li>
                        <label for="mq">Mq</label>
                        <input name="mq" id="mq" type="number">
                    </li>
                    <li></li>
                </ul>
            </div>
            <button type="submit">Go</button>
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