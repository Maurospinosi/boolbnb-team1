@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Ciao, utente!') }}
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-inline list-unstyled">
                            <li class="list-inline-item">
                                <button type="button" class="btn btn-light"><a href="{{route("host/message.index")}}">Messaggi</a></button>
                            </li>
                            <li class="list-inline-item">
                                <button type="button" class="btn btn-light"><a href="{{route("host/house.index")}}">Le tue case</a></button>
                            </li>
                        
                        </ul>
                    </div>
                </div>
            </div>
@endsection
