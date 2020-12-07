@extends('layouts.main')

@section('title')
    My Houses
@endsection

@section('page-content')

    <div class="container">
        
        
        {{-- @dd($house->houseinfo->description); --}}
        <div class="row">
            @foreach($houses as $house)
                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card h-100">
                        @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                                    <img class="card-img-top" src="{{$house->houseinfo->cover_image}}" alt="random picture">
                                @else
                                    <img class="card-img-top" src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="random picture">
                                @endif
                        <div class="card-body">
                            <h4 class="card-title titolo">{{$house->houseinfo->title}}</h4>
                            <h5 class="sottotitolo">{{$house->houseinfo->price}}</h5>
                        </div>
                        <div class="card-footer d-flex justify-content-center ">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-edit"><a href="{{route("host/house.edit", $house->id)}}">Modifica</a></button>
                                <button type="button" class="btn btn-show"><a href="{{route("host/house.show", $house->id)}}">Mostra</a></button>
                                
                                <form action=" {{route("host/house.destroy", $house->id)}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    </form><button type="button" class="btn btn-delete">Cancella</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection