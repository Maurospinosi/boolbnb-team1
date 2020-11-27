@extends('layouts.main')

@section('title')
    Ricerca
@endsection

@section('page-content')
    <form action="{{route('guest/search/results')}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="form-address">Via</label>
            <input type="search" class="form-control" placeholder="scrivi un indirizzo" id="form-address">
        </div>
            <input hidden type="text" class="form-control" id="form-address2" placeholder="Regione" name="region">
            <input hidden type="text" class="form-control" name="zipcode" id="form-zip" placeholder="CAP">
            <input hidden type="text" class="form-control" name="city" id="form-city" placeholder="Città">
            <input hidden type="text" class="form-control" name="country" id="form-country" placeholder="Nazione">
            <input hidden type="text" class="form-control" name="lat" id="form-lat"/>
            <input hidden type="text" class="form-control" name="lon" id="form-lng"/>

            <input type="submit" value="Vai">
    </form>
@endsection

