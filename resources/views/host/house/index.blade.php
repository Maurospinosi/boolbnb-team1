@extends('layouts.main')

@section('title')
    My Houses
@endsection

@section('page-content')

    <div class="container">
        
    @if(count($houses) > 0)
        <h2 id="host-index-title">Le mie case</h2>
        <div class="row">
            @foreach($houses as $house)
                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card h-100">
                        @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                        <img class="d-block w-100" src="<?php echo "https://res.cloudinary.com/dofcj4o0y/image/upload/w_300,h_200,c_thumb,q_100,f_auto/". str_replace("https://res.cloudinary.com/dofcj4o0y/image/upload/", "", "{$house->houseinfo->cover_image}") ?>" alt="random picture">
                            @else
                                <img class="card-img-top" src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="random picture">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title titolo">{{$house->houseinfo->title}}</h4>
                        </div>
                        <div class="card-footer d-flex justify-content-center ">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-edit"><a href="{{route("host/house.edit", $house->id)}}">Modifica</a></button>
                                <button type="button" class="btn btn-show"><a href="{{route("host/house.show", $house->id)}}">Mostra</a></button>
                                
                                <form action=" {{route("host/house.destroy", $house->id)}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-delete">Cancella</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h2 class="host-index-no-houses">Non hai ancora aggiunto case</h2>
    @endif
@endsection