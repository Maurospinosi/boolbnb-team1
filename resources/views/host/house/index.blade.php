@extends('layouts.main')

@section('title')
My Houses
@endsection

@section('page-content')

    <div class="container">
        @foreach($houses as $house)
        @dd($house->houseinfo)
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{$house->houseinfo->cover_image}}" alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection