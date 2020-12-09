@extends('layouts.main')

@section('title')
    My messages
@endsection

@section('page-content')
<div class="container">
    <h1 class="text-center">I miei messaggi</h1>
    <div class="table-responsive">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Casa</th>
            <th scope="col">Nome utente</th>
            <th scope="col">Email</th>
            <th scope="col">Azioni</th>
        </tr>
        </thead>
            
        @foreach ($messages as $message)
        <tbody>

            <tr>
              
                <td>{{$message->house->houseinfo->title}}</td>
                <td>{{$message->guest_name}}</td>
                <td>{{$message->email}}</td>
                <td>
                    <div class="d-inline-flex mb-2">
                        <button class="btn btn-dark mr-1 " type="button" data-toggle="collapse" data-target="#collapseExample{{$message->id}}" aria-expanded="false" aria-controls="collapseExample{{$message->id}}">
                            Mostra
                        </button>
                        <form action=" {{route("host/message.destroy", $message->id)}}" method="post">
                            @csrf
                            @method("DELETE")
                                <button class="btn btn-danger">Cancella</button>
                        </form>
                    </div>
                    <div class="collapse multi-collapse" id="collapseExample{{$message->id}}">
                        <div class="card card-body w-100">
                            <div>
                            {{$message->message}}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            
            </tbody>
        @endforeach
    </table>
</div>
</div>

@endsection