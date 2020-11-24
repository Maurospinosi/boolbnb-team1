@extends('layouts.main')

@section('title')
Aggiungi una nuova casa
@endsection

@section('page-content')

    <div class="container">
        <form action="{{route('host/house.store')}}" method="POST" enctype="multipart/form-data">

            @csrf
            @method("POST")
    
    
                <div style="margin-top: 50px" class="form-group">
                    <label for="title">Titolo</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Inserisci il titolo"{{old("title")}}>
                </div>
                
                <div class="form-group">
                    <label for="rooms">Numero di stanze</label>
                    <input type="number" class="form-control" name="rooms" id="rooms" placeholder="Numero di stanze"{{old("rooms")}}>
                </div>

                <div class="form-group">
                    <label for="beds">Numero di letti</label>
                    <input type="number" class="form-control" name="beds" id="beds" placeholder="Numero di letti" {{old("beds")}}>
                </div>

                <div class="form-group">
                    <label for="bathrooms">Numero di bagni</label>
                    <input type="number" class="form-control" name="bathrooms" id="bathrooms" placeholder="Numero di bagni" {{old("bathrooms")}}>
                </div>

                <div class="form-group">
                    <label for="mq">Numero di mq</label>
                    <input type="number" class="form-control" name="mq" id="mq" placeholder="Numero di mq" {{old("mq")}}>
                </div>

                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Inserisci la descrizione">{{old("description")}}</textarea>
                </div>

                <div class="form-group">
                    <label for="form-address">Address*</label>
                    <input type="search" class="form-control" id="form-address" placeholder="Where do you live?" {{old("address")}}>
                </div>
                <div class="form-group">
                    <label for="form-address2">Address 2</label>
                    <input type="text" class="form-control" name="address" id="form-address2" placeholder="Street number and name" {{old("address")}}>
                </div>
                <div class="form-group">
                    <label for="form-country">Country</label>
                    <input type="text" class="form-control" name="country" id="form-country" placeholder="Country" {{old("country")}}>
                </div>
                <div class="form-group">
                    <label for="form-city">City*</label>
                    <input type="text" class="form-control" name="city" id="form-city" placeholder="City" {{old("city")}}>
                </div>
                <div class="form-group">
                    <label for="form-zip">ZIP code*</label>
                    <input type="text" class="form-control" name="zipcode" id="form-zip" placeholder="ZIP code" {{old("zipcode")}}>
                </div>

                <div class="form-group">
                    <label for="price">Prezzo</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Inserisci il prezzo" {{old("price")}}>
                </div>
    
                <div class="form-group">
                    <label for="cover_image">Immagine di copertina</label>
                    <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="Inserisci immagine" accept="image/*" {{old("cover_image")}}>
                </div>

                <div class="form-group">
                    <label for="url">Altre immagini</label>
                    <input type="file" class="form-control" id="url" name="url[]" placeholder="Inserisci immagine" multiple="multiple" accept="image/*" {{old("url")}}>
                </div>

                <div class="form-group">
                    <label for="visible">Rendi visibile</label>
                    <input type="checkbox" id="visible" name="visible" value="1">
                </div>

                <input hidden
                        type="text"
                        class="form-control"
                        id="form-lat"
                        name="lat"
                        />
                <input hidden
                type="text"
                class="form-control"
                id="form-lng"
                name="lon"
                />
    
                <button type="submit" class="btn btn-primary">Crea</button>
          </form>
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
    </div>
@endsection