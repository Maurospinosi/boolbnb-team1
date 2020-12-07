

@component('mail::message')
<h1>Grazie per  esserti registrato al sito</h1>
<h2>I tuoi dati:</h2>
<ul>
    <li>{{$dati["host_email"]}}</li>
    <li>{{$dati["host_name"]}}</li>
    <li>{{$dati["birth_date"]}}</li>

</ul>

@component('mail::button', ['url' => ''])
Inserisci una casa
@endcomponent

Thanks,<br>
Boolbnb Team 1
@endcomponent
