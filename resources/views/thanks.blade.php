@extends('layouts.front')

@section('content')
    <h2 class="alert alert-success">
        Muito obrigado por sua compra!
    </h2>
    <h3>
        Seu pedido foi processado, código do pedido: {{request()->get('order')}}.
        <br>
        @if(request()->has('b'))
            <a href="{{request()->get('b')}}" target="_blank" class="btn btn-lg btn-danger">Imprimir boleto</a>
        @endif
    </h3>
@endsection 
