
@component('mail::message')

<div class="container d-flex">
    <img class="cover-image" src="{{$dati["cover"]}}" alt="">
    <h2 id="title-house">{{$dati['title']}} <br> {{$dati['price']}}€</h2>
</div>

<h1>Ciao {{$dati["host_name"]}}, hai un nuovo messaggio</h1>

<div class="body-message">
    <h3>Da: {{$dati["guest_name"]}}</h3>
    <p>{{$dati["text_message"]}}</p>
</div>


@component('mail::button', ['url' => ''])
@endcomponent
    <div class="action">
        <a class="button button-primary " href="{{route('host/message.index')}}">Visualizza</a>
    </div>

Boolbnb Team 1
@endcomponent
