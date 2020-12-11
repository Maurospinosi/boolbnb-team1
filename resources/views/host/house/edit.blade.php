@extends('layouts.main')

@section('title')
Modifica la tua casa
@endsection

@section('page-content')

    <div class="container">
        <div class="row">
            
            <div class="col-md-12 col-lg-12 pt-3 px-4 bg-white">
                <div class="d-sm-flex align-items-center justify-content-center mb-4 titolo-scheda">
                    <span>Modifica la tua casa</span>
                </div>
                
            </div>
            <div class="col-md-12 col-lg-12  bg-white">
                <div class="d-flex p-2 align-items-center justify-content-end">
             
                <a href="{{route('host/house.show', $house->id)}}" class="btn btn-info">Indietro</a>
            </div>
            
        </div>
    </div>
        <div class="container edit-house">


            <form class="w-100  form-edit shadow p-3 mb-10 mt-3 bg-white rounded" action="{{route('host/house.update', $house->id)}}" method="POST" enctype="multipart/form-data">

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
                        <input readonly type="text" class="form-control" id="form-address2" placeholder="Regione" name="region" value="{{$house->houseinfo->region}}">
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
                    @if ($house->visible == 1)
                        <div class="form-group">
                            <label for="invisible">Rendi non visibile</label>
                            <input type="checkbox" id="invisible" name="visible" value="0">
                        </div>
                    @else
                        <div class="form-group">
                            <label for="visible">Rendi visibile</label>
                            <input type="checkbox" id="visible" name="visible" value="1">
                        </div>
                    @endif

                    <input hidden type="text" class="form-control" id="form-lat" name="lat" value="{{$house->houseinfo->lat}}"/>
                    <input hidden type="text" class="form-control" id="form-lng" name="lon" value="{{$house->houseinfo->lon}}"/>
        
                    <button type="submit" class="btn btn-primary salva">Salva</button>
                </div>
                </form>
        </div>
  
    <script id="image-template" type="text/x-handlebars-template">
        <input type="file" class="form-control" id="url" name="url" placeholder="Inserisci immagine" accept="image/*"  value="{{old("url")}}">
    </script>      
@endsection