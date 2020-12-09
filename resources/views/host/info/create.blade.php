@extends('layouts.main')

@section('page-content')
    <div class="container create-user">
        <h2>Completa la registrazione con i tuoi dati</h2>
        <form class="form-create-user mx-auto w-50 form-create shadow p-3 mb-5 mt-5 bg-white rounded" action="{{route('host/info/store')}}" method="POST" enctype="multipart/form-data">

            @csrf
            @method("POST")
    
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input style="color: grey" type="text" readonly class="form-control-plaintext" name="name" id="name" value="{{$user_name}}">
                </div>
    
                <div class="form-group">
                    <label for="lastname">Cognome</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Cognome" value="{{old("lastname")}}">
                    <small id="nameHelp" class="form-text text-muted">Campo non obbligatorio</small>

                    @error('lastname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label for="date_of_birth">Data di nascita</label>
                    <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" value="{{old("date_of_birth")}}">
                    <small id="date_of_birthHelp" class="form-text text-muted">Campo non obbligatorio</small>

                    @error('date_of_birth')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="m" value="m">
                        <label class="form-check-label" for="m">
                        Uomo
                        </label>
                    </div>
                    @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="f" value="f">
                        <label class="form-check-label" for="f">
                        Donna
                        </label>                        
                    </div>
                    @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                        <label for="form-city-info">Città</label>
                        <input type="text" name="city" id="form-city-info" placeholder="Immettere nome città" value="{{old("city")}}">
                        <small id="form-city-infoHelp" class="form-text text-muted">Campo non obbligatorio</small>

                        @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="picture">Immagine del profilo</label>
                    <input type="file" class="pt-1 form-control" id="picture" name="picture" placeholder="Inserisci immagine" accept="image/*" value="{{old("picture")}}">
                    <small id="pictureHelp" class="form-text text-muted">Campo non obbligatorio</small>

                    @error('picture')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
    
                <button type="submit" class="btn btn-pink">Completa registrazione</button>
        </form>
    </div>
    <script src="{{asset('js/citysearchregister.js')}}"></script>
@endsection
    

