@extends('layouts.main')

@section('title')
My Houses
@endsection

@section('page-content')

    <div class="container">
        @foreach($houses as $house)
               <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{$house->houseinfo->cover_image}}" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{$house->houseinfo->title}}</h5>
                    <a href="{{route("host/house.edit", $house->id)}}" class="btn btn-primary">Edit</a>
             </div>
        </div>
        @endforeach
    </div>
@endsection