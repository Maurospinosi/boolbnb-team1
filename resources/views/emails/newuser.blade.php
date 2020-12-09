

@component('mail::message')
<img id="beautiful-house" src="{{asset('../img/beautiful-house.jpg')}}" class="logo" alt="house">
<h2>Ciao {{$dati["host_name"]}},</h2>
<h2>Benvenuto su Boolbnb.</h2>
<p>Adesso che sei un host, dai un'occhiata a tutto quello che puoi fare!! Per cominciare, perchè non inserisci la tua prima casa? </p>

@component('mail::button', ['url' => ''])
@endcomponent

<div class="action">
    <a class="button button-primary " href="http://localhost:8000/host/house/create">Inserisci una casa</a>
    </div>


Boolbnb Team 1
@endcomponent
