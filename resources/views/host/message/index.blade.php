@extends('layouts.main')

@section('title')
    My messages
@endsection

@section('page-content')

<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Numero messaggio</th>
        <th scope="col">Nome utente</th>
        <th scope="col">Email</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    @foreach ($messages as $message)
        <tbody>
        <tr>
            <th>{{$message->house_id}}</th>
            <td>{{$message->guest_name}}</td>
            <td>{{$message->email}}</td>
            <td>@mdo</td>
        </tr>
        
        </tbody>
        
    @endforeach
  </table>
  

@endsection