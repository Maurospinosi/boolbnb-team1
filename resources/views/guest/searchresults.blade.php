@extends('layouts.main')

@section('title')
    Risultati
@endsection


@section('page-content')
    
    <div class="container">

        {{-- @dd($houses_info); --}}

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