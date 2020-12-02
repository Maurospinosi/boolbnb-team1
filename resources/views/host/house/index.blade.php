@extends('layouts.main')

@section('title')
    My Houses
@endsection

@section('page-content')

    <div class="container">
        @foreach($houses as $house)
               <div class="card" style="width: 18rem;">
                        @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                            <img class="card-img-top" src="{{$house->houseinfo->cover_image}}" alt="random picture">
                        @else
                            <img class="card-img-top" src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="random picture">
                        @endif
                    <div class="card-body">
                    <h5 class="card-title">{{$house->houseinfo->title}}</h5>
                    <a href="{{route("host/house.edit", $house->id)}}" class="btn btn-primary">Modifica</a>
                    <a href="{{route("host/house.show", $house->id)}}" class="btn btn-warning">Mostra</a>
                    <form action=" {{route("host/house.destroy", $house->id)}}" method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-primary">Cancella</button>
                    </form>
             </div>
        </div>
        @endforeach
    </div>

@endsection