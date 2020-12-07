

@component('mail::message')
<h1>Ciao, {{$dati["user_name"]}}!</h1>
<h2>Hai aggiunto con successo la casa {{$dati["title"]}}</h2>

@component('mail::button', ['url' => ''])
Visualizza
@endcomponent

Thanks,<br>
Boolbnb Team 1
@endcomponent
