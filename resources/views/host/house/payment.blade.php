@extends('layouts.main')

@section('title')
    Payment
@endsection

@section('page-content')
  
  <div class="container">
    <div class="col-md-12 col-lg-12 pt-3 px-4 bg-white">
      <div class="d-sm-flex align-items-center justify-content-center mb-4  mx-auto titolo-scheda">
        <span>Pagamento sponsorizzazione: {{$amount}} €</span>
      </div>
        <form id="payment-form" class="justify-content-center w-75 mx-auto" action="{{route('host/payment')}}" method="get">
        
          <div id="dropin-container"></div>
          <input type="submit" class="btn-payment" />
          <input type="hidden" id="nonce" name="payment_method_nonce"/>
          <input type="hidden" name="amount" value="{{$amount}}">
          <input type="hidden" name="house_id" value="{{$house_id}}">
          <input type="hidden" name="url" value="{{$url}}">
        </form>
      </div>
    </div>
  </div>  

@endsection