@extends('layouts.main')

@section('title')
    BoolBnb
@endsection

@section('page-content')
    
{{-- Jumbotron --}}
<div class="no-wrap">
    <div class="jumbotron ">
        <h2>Scegli la prossima meta delle tue vacanze...</h2>
    </div>
</div>
{{-- fine Jumbotron --}}


<div class="container" id="welcome-container">
    <h2 id="welcome-title">Selezionate per te...</h2>
    <div class="row">
        @foreach($housesToPrint as $house)
            <div class="col-lg-4 col-md-6 mb-4">
    
                <div class="card h-100">
                    @if (count($house->sponsors) > 0)
                        <span class="bg-azzurro sponsorizzata rounded-top">In evidenza</span>
                    @endif

                    <div class="img-container">
                        @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                            <img class="d-block w-100" src="<?php echo "https://res.cloudinary.com/dofcj4o0y/image/upload/w_300,h_200,c_thumb,q_100,f_auto/". str_replace("https://res.cloudinary.com/dofcj4o0y/image/upload/", "", "{$house->houseinfo->cover_image}") ?>" alt="random picture">
                        @else
                            <img class="card-img-top rounded-top-0" src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
                        @endif    
                    </div>
    
                    <div class="card-body">
                        <h4 class="card-title titolo">{{$house->houseinfo->title}}</h4>
                    </div>
                    <div class="card-footer d-flex justify-content-center ">
                            <a href="
                                @if (Auth::id() == $house->user_id)
                                {{route("host/house.show", $house->id)}}
                                @else
                                {{route("guest/house", $house->slug)}}
                                @endif"><button type="button" class="btn btn-scopri">Scopri</button>
                            </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

