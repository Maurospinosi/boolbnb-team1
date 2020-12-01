@extends('layouts.main')

@section('title')
    My Houses
@endsection

@section('page-content')

    <div class="container">
        
        @foreach($houses as $house)

            <div class="card" style="width: 18rem;">
               
                @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                    <img src="{{$house->houseinfo->cover_image}}" alt="random picture">
                @else
                    <img src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
                @endif    
                    
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
=======
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
=======
>>>>>>> Stashed changes
=======
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{$house->houseinfo->cover_image}}" alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
>>>>>>> Stashed changes
>>>>>>> Stashed changes
        </div>
        @endforeach
    </div>

@endsection