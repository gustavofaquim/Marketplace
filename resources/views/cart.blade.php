@extends('layouts.front')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Carrinho de Compras</h2>
        </div>
        
        <div class="col col-lg-8">
           @if($cart)
           
            <table class="table" id="cart">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Entrega</th>
                        <th>Preço</th>
                     </tr>
                </thead>

                <tbody>
                    @php 
                        $total = 0;
                    @endphp
                    @foreach($cart as $c)
                   
                        <tr>
                            <td id="tdName">
                                @if($c['photo'])
                                    <img src="{{asset('storage/'. $c['photo'])}}" id="img-thumb" alt="">    
                                @endif
                                {{$c['name']}}
                            
                            </td>
                            <td id="tdAmount"> 
                                <input type="number" name="product[amount]" id="amount" class="form-control" value="{{$c['amount']}}" min="1"> 
                                <a href="{{ route('cart.remove', ['slug'=>$c['slug']])}}" class="">remover</a>
                            </td>
                            <td id="tdShipping"> receba até 20 de junho</td>
                                
                            @php
                                $subtotal = $c['price'] * $c['amount'];
                                $total += $subtotal;
                            @endphp
                            <td> R$ {{$total}}</td>
                        </tr>
                    @endforeach                        
                </tbody>
            </table>
        </div>
        <div class="col" id="summaryCart">
            <h2>Resumo</h2>
            <a href="{{ route('checkout.index')}}" class="btn btn-lg btn-success float-right">Concluir Compra</a>
        </div>
    
        <div class="col-md-12">
            <form action="" id="formCep" >
                <p>Calcular frete e prazo de entrega</p>
                <input type="text" class="" name="frete" id="frete">
                <button>calcular</button>
            </form> 
        </div>

        <div class="col-md-12" id="cartCancel">
            <a href="{{route('cart.cancel')}}" class="btn btn-lg btn-danger float-left">Cancelar Comprar</a>
        </div>
    
    </div>
            
    
                
        @else
        <div class="alert alert-warning">Carrinho Vazio...</div>
        @endif
        
    

    

@endsection 

@section('scripts')

@endsection