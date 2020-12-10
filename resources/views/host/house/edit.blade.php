@extends('layouts.main')

@section('title')
Modifica la tua casa
@endsection

@section('page-content')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
    input[type=number] {
  -moz-appearance: textfield;
}

ul {
    list-style: none
}
</style>

<div class="container-fluid">
    <div class="row">
 {{-- Tasti di Modifica, Cancella e Sponsorizza --}}
         @if(Auth::id() == $house->user_id)
        <nav class="col-md-2 col-lg-2 d-flex flex-column d-md-block bg-light sidebar">
            <div class="sidebar-sticky host-nav-col justify-content-start">
                <div class="nav d-flex flex-column host-nav">
                    <div class="nav-item d-inline-flex p-2 align-items-center ">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-home"></i> Bacheca 
                            <span class="sr-only">(current)</span>
                        </a>
                    </div>
                </div>
                <div class="nav d-flex flex-column host-nav">
                    <div class="nav-item d-inline-flex p-2 align-items-center ">
                        <a class="nav-link" href="{{route("host/house.edit", $house->id)}}">
                            <i class="far fa-edit"></i>
                            <span>Modifica</span>
                        </a>   
                    </div>
                </div>
                <div class="nav d-flex flex-column host-nav">
                    <div class="nav-item d-inline-flex p-2 align-items-center ">
                        <a class="nav-link">
                            <form action="{{route("host/house.destroy", $house->id)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <i class="far fa-trash-alt"></i>
                                <input id="delete-button" type="submit" value="Cancella">
                            </form>
                        </a>   
                    </div>
                    @if (count($house->sponsors) == 0)
                    <div class="nav d-flex flex-column host-nav">
                        <div class="nav-item d-inline-flex p-2 align-items-center ">
                        <!-- Nav Item - Utilities Collapse Menu -->
                            <a class="nav-link"> 
                                <i class="far fa-credit-card"></i>
                                <span id="open-sponsor-menu">Sponsorizza</span>
                            </a>
                       
                            <li id="host-sponsorship" class="d-none">
                                <form action="{{route("host/sponsorship", $house->user_id)}}" method="GET">
                                    @csrf
                                    @method("GET")
                                    <select class="form-control" name="amount">
                                        <option value="" selected>Seleziona</option>
                                        <option value="2.99">2.99€ / 24h</option>
                                        <option value="5.99">5.99€ / 72h</option>
                                        <option value="9.99">9.99€ / 144h</option>
                                    </select>
                                    <input type="hidden" name="url" value="{{Request::url()}}">
                                    <input type="hidden" name="house_id" value="{{$house->id}}">
                                    <input class="form-control" type="submit" value="Vai">
                                </form>
                            </li>
                        </div>
                    </div>
                    @endif
                    <div class="nav d-flex flex-column host-nav">
                        <div class="nav-item d-inline-flex p-2 align-items-center ">
                            <a class="nav-link" href="{{route("host/house/statistic", $house->id)}}">
                                <i class="fas fa-chart-line"></i>
                                <span>Statistiche</span>
                            </a>   
                        </div>
                    </div>
                    <div class="nav d-flex flex-column host-nav">
                        <div class="nav-item d-inline-flex p-2 align-items-center ">
                            <a class="nav-link" href="{{route('host/message.index', $house->id)}}">
                                <i class="fas fa-envelope-open-text"></i>
                                <span>Leggi i messaggi</span>
                            </a> 
                        </div> 
                    </div>
                </div>
            </div>
        </nav>
        @endif

        <div class="container edit-house">

            <h2 class="text-secondary font-weight-bold">Modifica la tua Casa</h2>

            <form class="w-100  form-edit shadow p-3 mb-5 mt-5 bg-white rounded" action="{{route('host/house.update', $house->id)}}" method="POST" enctype="multipart/form-data">

                @csrf
                @method("PUT")
                    <div class="">
                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Inserisci il titolo" value="{{$house->houseinfo->title}}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                    <div class="form-group">
                        <label for="rooms">Numero di stanze</label>
                        <input min="0" type="number" class="form-control" name="rooms" id="rooms" placeholder="Numero di stanze" value="{{$house->houseinfo->rooms}}">
                        @error('rooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="beds">Numero di letti</label>
                        <input min="1" type="number" class="form-control" name="beds" id="beds" placeholder="Numero di letti"  value="{{$house->houseinfo->beds}}">
                        @error('beds')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="bathrooms">Numero di bagni</label>
                        <input min="0" type="number" class="form-control" name="bathrooms" id="bathrooms" placeholder="Numero di bagni"  value="{{$house->houseinfo->bathrooms}}">
                        @error('bathrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mq">Numero di mq</label>
                        <input min="10" type="number" class="form-control" name="mq" id="mq" placeholder="Numero di mq"  value="{{$house->houseinfo->mq}}">
                        @error('mq')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="7" placeholder="Inserisci la descrizione">{{$house->houseinfo->description}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Prezzo</label>
                        <input min="5" type="number" class="form-control" name="price" id="price" placeholder="Inserisci il prezzo" value="{{$house->houseinfo->price}}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label for="form-address">Via*</label>
                        <input type="search" class="form-control" id="form-address" placeholder="Inserisci via e numero" name="address" value="{{$house->houseinfo->address}}">
                    </div>

                    <div class="form-group">
                        <label for="form-address2">Regione</label>
                        <input readonly type="text" class="form-control" id="form-address2" placeholder="Regione" value="{{$house->houseinfo->region}}">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>        
                    
                    <div class="form-group">
                        <label for="form-zip">CAP*</label>
                        <input readonly type="text" class="form-control" name="zipcode" id="form-zip" placeholder="CAP" value="{{$house->houseinfo->zipcode}}">
                        @error('zipcode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="form-city">Città*</label>
                        <input readonly type="text" class="form-control" name="city" id="form-city" placeholder="Città"  value="{{$house->houseinfo->city}}">
                        @error('city')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="form-country">Nazione</label>
                        <input readonly type="text" class="form-control" name="country" id="form-country" placeholder="Nazione"  value="{{$house->houseinfo->country}}">
                        @error('country')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <h6>Servizi</h6>
                            <ul>
                                @foreach($services as $service)
                                    <li>
                                        <label class="font-weight-normal text-secondary" for="service{{$service->id}}">{{$service->name}}</label>
                                        <input type="checkbox" name="services[]" id="service{{$service->id}}" value="{{$service->id}}"
                                        @if ($house->services->contains($service->id))
                                            checked
                                        @endif>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="form-group">
                            <h6>Tag</h6>
                            <ul>
                                @foreach($tags as $tag)
                                <li>
                                    <label class="font-weight-normal text-secondary" for="tag{{$tag->id}}">{{$tag->name}}</label>
                                    <input type="checkbox" name="tags[]" id="tag{{$tag->id}}" value="{{$tag->id}}"
                                    @if ($house->tags->contains($tag->id))
                                        checked
                                    @endif>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
        
                    <div class="form-group">
                        <label for="cover_image">Immagine di copertina</label>
                        <input type="file" class="pt-1 form-control" id="cover_image" name="cover_image" placeholder="Inserisci immagine" accept="image/*"  value="{{$house->houseinfo->cover_image}}">
                        @error('cover_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="visible">Rendi visibile</label>
                        <input type="checkbox" id="visible" name="visible" value="1">
                    </div>

                    <input hidden type="text" class="form-control" id="form-lat" name="lat" value="{{$house->houseinfo->lat}}"/>
                    <input hidden type="text" class="form-control" id="form-lng" name="lon" value="{{$house->houseinfo->lon}}"/>
        
                    <button type="submit" class="btn btn-primary salva">Salva</button>
                </div>
                </form>
        </div>
    </div>
    <script id="image-template" type="text/x-handlebars-template">
        <input type="file" class="form-control" id="url" name="url" placeholder="Inserisci immagine" accept="image/*"  value="{{old("url")}}">
    </script>      
@endsection