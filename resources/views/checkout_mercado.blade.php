@extends('layouts.front')

@section('stylesheets')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@endsection

@section('content')

<div class="container">


<!-- Step #2 -->

<form id="form-checkout" aciton="{{route('checkout.process_payment')}}" >
  @csrf
   <input type="text" name="cardNumber" id="form-checkout__cardNumber" />
   <input type="text" name="cardExpirationMonth" id="form-checkout__cardExpirationMonth" />
   <input type="text" name="cardExpirationYear" id="form-checkout__cardExpirationYear" />
   <input type="text" name="cardholderName" id="form-checkout__cardholderName"/>
   <input type="email" name="cardholderEmail" id="form-checkout__cardholderEmail"/>
   <input type="text" name="securityCode" id="form-checkout__securityCode" />
   <select name="issuer" id="form-checkout__issuer"></select>
   <select name="identificationType" id="form-checkout__identificationType"></select>
   <input type="text" name="identificationNumber" id="form-checkout__identificationNumber"/>
   <select name="installments" id="form-checkout__installments"></select>
   <button type="submit" id="form-checkout__submit">Pagar</button>
   <progress value="0" class="progress-bar">Carregando...</progress>
</form>
  
</div>
@endsection 

@section('scripts')
    
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    
    <script>
      const mp = new MercadoPago('TEST-61708fef-da0e-455a-aee3-e7a1a4b27e81');

      
      const cartItens = '{{$cartItems}}';
     
    </script>
    
  <script src="{{asset('js/mercadopago.js')}}"></script>
    
   
    
    
@endsection 


