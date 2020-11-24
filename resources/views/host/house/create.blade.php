@extends('layouts.main')

@section('title')
Aggiungi una nuova casa
@endsection

@section('page-content')

    <div class="container">
        <form action="{{route('host/house.create')}}" method="POST" enctype="multipart/form-data">

            @csrf
            @method("POST")
    
    
                <div style="margin-top: 50px" class="form-group">
                    <label for="title">Titolo</label>
                    <input style="color: grey" type="text" readonly class="form-control-plaintext" name="title" id="title" placeholder="Inserisci il titolo">
                </div>
                
                <div class="form-group">
                    <label for="rooms">Numero di stanze</label>
                    <input type="number" class="form-control" name="rooms" id="rooms" placeholder="Numero di stanze">
                </div>

                <div class="form-group">
                    <label for="beds">Numero di letti</label>
                    <input type="number" class="form-control" name="beds" id="beds" placeholder="Numero di letti">
                </div>

                <div class="form-group">
                    <label for="bathrooms">Numero di bagni</label>
                    <input type="number" class="form-control" name="bathrooms" id="bathrooms" placeholder="Numero di bagni">
                </div>

                <div class="form-group">
                    <label for="mq">Numero di mq</label>
                    <input type="number" class="form-control" name="mq" id="mq" placeholder="Numero di mq">
                </div>

                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Inserisci la descrizione"></textarea>
                </div>

                <div class="form-group">
                    <label for="address">Indirizzo</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Inserisci l'indirizzo">
                </div>

                <div class="form-group">
                    <label for="country">Paese</label>
                    <input type="text" class="form-control" name="country" id="country" placeholder="Inserisci il paese">
                </div>

                <div class="form-group">
                    <label for="city">Città</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="Inserisci la città">
                </div>

                <div class="form-group">
                    <label for="zipcode">Codice postale</label>
                    <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Inserisci il codice postale">
                </div>
    
                <div class="form-group">
                    <label for="price">Prezzo</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Inserisci il prezzo">
                </div>
    
                <div class="form-group">
                    <label for="cover_image">Immagine</label>
                    <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="Inserisci immagine" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="address-input">Immagine</label>
                    <input type="search" class="form-control" id="address-input" name="address-input" placeholder="Dove vuoi andare?">
                </div>
    
    
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