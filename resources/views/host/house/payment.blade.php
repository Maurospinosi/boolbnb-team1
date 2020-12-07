@extends('layouts.main')

@section('title')
    Payment
@endsection

@section('page-content')
  <div class="container">
    <form id="payment-form" action="{{route('host/payment')}}" method="get">
      <h3>Pagamento sponsorizzazione: {{$amount}}</h3>
        <div id="dropin-container"></div>
        <input type="submit" />
        <input type="hidden" id="nonce" name="payment_method_nonce"/>
        <input type="hidden" name="amount" value="{{$amount}}">
        <input type="hidden" name="url" value="{{$url}}">
    </form>
  </div>  

@endsection