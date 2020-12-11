@component('mail::message')

<h1>Ciao, {{$dati["user_name"]}}!</h1>
<h2>La tua casa "{{$dati["title"]}}" è ora online. </h2>
<p> Ti auguriamo di ottenere i risultati sperati. <br> Se vuoi affittare più velocemente, prova i nostri pacchetti di sponsorizzazione. <br> Ecco il riepilogo della tua casa:</p>

@component('mail::button', ['url' => ''])

@endcomponent
<div class="body-message">
    <div class="title">
         <h2 id="title-house">"{{$dati["title"]}}"</h2>
    </div>
    @if (strpos($dati['cover_image'], 'http') === 0) --}}
        <img class="item" style="width:100%" src="{{$dati['cover_image']}}" alt="Thumbnail [100%x225]" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> --}}
    @else
        <img class="item" style="width:100%" src="{{asset('storage/'.$dati['cover_image'])}}" alt="Thumbnail [100%x225]" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
    @endif      
    {{-- <img src="{{asset('storage/'.$dati['cover_image'])}}" alt="house_cover">
    <ul class="list-house">
        <li>Prezzo: {{$dati["price"]}}€</li>
        <li>Località: {{$dati["address"]}}, {{$dati["city"]}}</li>
        <li>Stanze: {{$dati["rooms"]}}</li>
        <li>Mq: {{$dati["mq"]}} </li>
        <li>...</li>
    </ul> --}}
    Prezzo: {{$dati["price"]}}€
    Località: {{$dati["address"]}}, {{$dati["city"]}}
    Stanze: {{$dati["rooms"]}}
    Mq: {{$dati["mq"]}} 
</div>
<div class="action">
<a class="button button-primary " href="{{route('host/house.show', $dati['house_id'])}}">Visualizza maggiori dettagli</a>
</div>


Boolbnb Team 1
@endcomponent
