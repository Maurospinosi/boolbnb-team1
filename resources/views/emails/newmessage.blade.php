
@component('mail::message')
<h1>Ciao {{$dati["host_name"]}}, hai ricevuto un nuovo messaggio da {{$dati["guest_name"]}}</h1>
<p>{{$dati["text_message"]}}</p>

@component('mail::button', ['url' => ''])
Vai al messaggio
@endcomponent

Thanks,<br>
Boolbnb Team 1
@endcomponent
