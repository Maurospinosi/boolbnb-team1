@extends('layouts.main')

@section('title')
Inserisci una nuova casa
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
    <div class="row">
        
        <div class="col-md-12 col-lg-12 pt-3 px-4 bg-white">
            <div class="d-sm-flex align-items-center justify-content-center mb-4 titolo-scheda">
                <span>Inserisci la tua casa</span>
            </div>
            
        </div>
        <div class="col-md-12 col-lg-12  bg-white">
            <div class="d-flex p-2 align-items-center justify-content-end">
         
            <a href="{{route('host/house.index')}}" class="btn btn-info">Indietro</a>
        </div>
        
    </div>
</div>
    <div class="container create-house">

        <div class="error_message">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form class="w-100 col-12 col-md-12 form-create shadow p-3 mb-10 mt-3 bg-white rounded" action="{{route('host/house.store')}}" method="POST" enctype="multipart/form-data">

            @csrf
            @method("POST")
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="title">Titolo*</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Inserisci il titolo" maxlength="100" required value="{{old("title")}}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="rooms">Numero di stanze*</label>
                    <input type="number" class="form-control" name="rooms" id="rooms" placeholder="Numero di stanze" min="1" max="100" required value="{{old("rooms")}}">
                    @error('rooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="beds">Numero di letti*</label>
                    <input type="number" class="form-control" name="beds" id="beds" min="1" max="50" required placeholder="Numero di letti"  value="{{old("beds")}}">
                    @error('beds')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bathrooms">Numero di bagni*</label>
                    <input type="number" class="form-control" name="bathrooms" id="bathrooms" placeholder="Numero di bagni" min="1" max="50" required value="{{old("bathrooms")}}">
                    @error('bathrooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mq">Numero di mq*</label>
                    <input type="number" class="form-control" name="mq" id="mq" placeholder="Numero di mq" min="10" max="32700" required value="{{old("mq")}}">
                    @error('mq')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="7" placeholder="Inserisci la descrizione" maxlength="1000">{{old("description")}}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Prezzo*</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Inserisci il prezzo" min="5" max="9999" required value="{{old("price")}}">
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="form-address">Via*</label>
                    <input type="search" class="form-control" name="address" id="form-address" placeholder="Inserisci via e numero" required value="{{old("address")}}">
                </div>

                <div class="form-group">
                    <label for="form-address2">Regione</label>
                    <input readonly type="text" class="form-control" id="form-address2" placeholder="Regione" name="region"  required value="{{old("address")}}">
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>     
                
                <div class="form-group">
                    <label for="form-zip">CAP*</label>
                    <input readonly type="text" class="form-control" name="zipcode" id="form-zip" placeholder="CAP" required value="{{old("zipcode")}}">
                    @error('zipcode')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="form-city">Città*</label>
                    <input readonly type="text" class="form-control" name="city" id="form-city" placeholder="Città" required value="{{old("city")}}">
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>                

                <div class="form-group">
                    <label for="form-country">Nazione*</label>
                    <input readonly type="text" class="form-control" name="country" id="form-country" placeholder="Nazione" required value="{{old("country")}}">
                    @error('country')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="tags_services d-flex justify-content-between">
                    <div class="form-group">
                        <h6>Servizi</h6>
                        <ul>
                            @foreach($services as $service)
                                <li>
                                    <label class=" font-weight-normal text-secondary" for="service{{$service->id}}">{{$service->name}}</label>
                                    <input type="checkbox" name="services[]" id="service{{$service->id}}" value="{{$service->id}}">
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
                                <input type="checkbox" name="tags[]" id="tag{{$tag->id}}" value="{{$tag->id}}">
                            </li>
                            @endforeach
                        </ul>
                    </div>
                 </div>
    
                <div class="form-group">
                    <label for="cover_image">Immagine di copertina</label>
                    <input type="file" class="pt-1 form-control" id="cover_image" name="cover_image" placeholder="Inserisci immagine" accept="image/*" required value="{{old("cover_image")}}">
                    @error('cover_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" id="other-images">
                    <label for="url">Altre immagini</label>
                    <input type="file" class="pt-1 form-control" id="url" name="url[]" placeholder="Inserisci immagine" accept="image/*"  value="{{old("url")}}" multiple="multiple">
                    @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{-- <h6 id="new-image">Aggiungi nuova immagine</h6> --}}
                </div>

                <div class="form-group">
                    <label for="visible">Rendi visibile</label>
                    <input type="checkbox" id="visible" name="visible" value="1">
                </div>
                <input hidden type="text" class="form-control" id="form-lat" name="lat"/>
                <input hidden type="text" class="form-control" id="form-lng" name="lon"/>
               
                
                <button type="submit" class="btn crea btn-primary">Crea</button>
            </div>
          </form>
    </div>
</div>    
    <script src="{{asset('js/algoliaaddress.js')}}"></script>
@endsection