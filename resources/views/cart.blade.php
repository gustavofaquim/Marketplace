@extends('layouts.front')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Carrinho de Compras</h2>
        </div>

        <div class="col-md-12">
           @if($cart)
            <table class="table" id="carrinhoCompras">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                    @php 
                        $total = 0;
                    @endphp
                    @foreach($cart as $c)
                            <tr>
                                <td>{{$c['name']}}</td>
                                <td> R$ {{number_format($c['price'],2,',','.')}}</td>
                                <td> <input type="number" name="product[amount]" id="amount" class="form-control" value="{{$c['amount']}}" min="1"> </td>
                                @php
                                    $subtotal = $c['price'] * $c['amount'];
                                    $total += $subtotal;
                                @endphp
                                <td>
                                    
                                </td>
                            </tr>
                    @endforeach

                        <tr>
                        <td>
                            <form action="">
                                <label for="frete">Calcular frete</label>
                                <input type="text" name="frete" id="frete">
                                <button>calcular</button>
                            </form>
                        </td>
                        <td>R$</td>
                        <td>20 dias</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2"> <span>R$ {{ number_format($total,2,',','.')}}</span> </td>
                        </tr>

                    </tbody>
                </table>
                <div class="col-md-12">
                    <a href="{{ route('checkout.index')}}" class="btn btn-lg btn-success float-right">Concluir Compra</a>
                    <a href="{{route('cart.cancel')}}" class="btn btn-lg btn-danger float-left">Cancelar Comprar</a>
                </div>
           @else
           <div class="alert alert-warning">Carrinho Vazio...</div>


           @endif
        </div>

        <a href="{{ route('cart.remove', ['slug'=>$c['slug']])}}" class="btn btn-sm btn-danger">x</a>
    </div>

@endsection 

@section('scripts')

@endsection