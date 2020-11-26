@extends('layouts.main')

@section('title')
Modifica la casa
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

    <div class="container">

        <h2>Modifica Casa</h2>

        <form action="{{route('host/house.update', $house->id)}}" method="POST" enctype="multipart/form-data">

            @csrf
            @method("PUT")
        
                <div style="margin-top: 50px" class="form-group">
                    <label for="title">Titolo</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Inserisci il titolo" value="{{$house->houseinfo->title}}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="rooms">Numero di stanze</label>
                    <input type="number" class="form-control" name="rooms" id="rooms" placeholder="Numero di stanze" value="{{$house->houseinfo->rooms}}">
                    @error('rooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="beds">Numero di letti</label>
                    <input type="number" class="form-control" name="beds" id="beds" placeholder="Numero di letti"  value="{{$house->houseinfo->beds}}">
                    @error('beds')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bathrooms">Numero di bagni</label>
                    <input type="number" class="form-control" name="bathrooms" id="bathrooms" placeholder="Numero di bagni"  value="{{$house->houseinfo->bathrooms}}">
                    @error('bathrooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mq">Numero di mq</label>
                    <input type="number" class="form-control" name="mq" id="mq" placeholder="Numero di mq"  value="{{$house->houseinfo->mq}}">
                    @error('mq')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Inserisci la descrizione">{{$house->houseinfo->description}}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="form-address">Via*</label>
                    <input type="search" class="form-control" id="form-address" placeholder="Inserisci via e numero" name="address" value="{{$house->houseinfo->address}}">
                </div>

                <div class="form-group">
                    <label for="form-address2">Regione</label>
                    <input type="text" class="form-control" id="form-address2" placeholder="Regione" value="{{$house->houseinfo->region}}">
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>        
                
                <div class="form-group">
                    <label for="form-zip">CAP*</label>
                    <input type="text" class="form-control" name="zipcode" id="form-zip" placeholder="CAP" value="{{$house->houseinfo->zipcode}}">
                    @error('zipcode')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="form-city">Città*</label>
                    <input type="text" class="form-control" name="city" id="form-city" placeholder="Città"  value="{{$house->houseinfo->city}}">
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="form-country">Nazione</label>
                    <input type="text" class="form-control" name="country" id="form-country" placeholder="Nazione"  value="{{$house->houseinfo->country}}">
                    @error('country')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Prezzo</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Inserisci il prezzo" value="{{$house->houseinfo->price}}">
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <h6>Servizi</h6>
                    <ul>
                        @foreach($services as $service)
                            <li>
                                <label for="service{{$service->id}}">{{$service->name}}</label>
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
                            <label for="tag{{$tag->id}}">{{$tag->name}}</label>
                            <input type="checkbox" name="tags[]" id="tag{{$tag->id}}" value="{{$tag->id}}"
                            @if ($house->tags->contains($tag->id))
                                checked
                            @endif>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- <div class="form-group">
                    <h6>Servizi</h6>
                    
                    @foreach($services as $service)
                        <label for="{{$service->id}}">{{$service->name}}</label>                      
                        <input type="checkbox" name="services[]" id="{{$service->id}}" value="{{$service->id}}"
                        @if ($house->services->contains($service->id))
                             checked
                         @endif> 
                        
                    @endforeach
                    @error('services')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <h6>Tags</h6>
                    
                    @foreach($tags as $tag)
                        <label for="{{$tag->id}}">{{$tag->name}}</label>                
                        <input type="checkbox" name="tags[]" id="{{$tag->id}}" value="{{$tag->id}}"
                        @if ($house->tags->contains($tag->id))
                             checked
                         @endif> 
                        
                    @endforeach
                    @error('services')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
    
                <div class="form-group">
                    <label for="cover_image">Immagine di copertina</label>
                    <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="Inserisci immagine" accept="image/*"  value="{{$house->houseinfo->cover_image}}">
                    @error('cover_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="form-group" id="other-images">
                    <label for="url">Altre immagini</label>
                    <input type="file" class="form-control" id="url" name="url" placeholder="Inserisci immagine" accept="image/*"  value="{{$house->images->url}}">
                    @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <h6 id="new-image">Aggiungi nuova immagine</h6>
                </div> --}}

                <div class="form-group">
                    <label for="visible">Rendi visibile</label>
                    <input type="checkbox" id="visible" name="visible" value="1">
                </div>

                <input hidden type="text" class="form-control" id="form-lat" name="lat" value="{{$house->houseinfo->lat}}"/>
                <input hidden type="text" class="form-control" id="form-lng" name="lon" value="{{$house->houseinfo->lon}}"/>
    
                <button type="submit" class="btn btn-primary">Salva</button>
          </form>
    </div>
    <script id="image-template" type="text/x-handlebars-template">
        <input type="file" class="form-control" id="url" name="url" placeholder="Inserisci immagine" accept="image/*"  value="{{old("url")}}">
    </script>      
@endsection