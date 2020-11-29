@extends('layouts.main')

@section('title')
    My Houses
@endsection

@section('page-content')

    <div class="container">
        @foreach($houses as $house)
        {{-- @dd($house->houseinfo->description); --}}
               <div class="card" style="width: 18rem;">
                    {{-- <img class="card-img-top" src="{{asset('storage/'. $house->houseinfo->cover_image)}}" alt="Card image cap"> --}}
                    <div class="card-body">                      
                            <h5 class="card-title">{{$house->houseinfo->title}}</h5>
                        <a href="{{route("host/house.edit", $house->id)}}" class="btn btn-primary">Edit</a>
                        <a href="{{route("host/house.show", $house->id)}}" class="btn btn-warning">Show</a>
                    </div>
{{-- @dd($house->houseinfo->cover_image) --}}
{{-- {{$house->houseinfo->cover_image}} --}}

               <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset('storage/'. $house->houseinfo->cover_image)}}" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{$house->houseinfo->title}}</h5>
                    <a href="{{route("host/house.edit", $house->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{route("host/house.show", $house->id)}}" class="btn btn-warning">Show</a>
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