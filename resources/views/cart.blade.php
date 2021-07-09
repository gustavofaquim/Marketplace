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
                        $price = 0.0;
                        $x = 0;
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
                                <input type="number" name="amount-{{$x}}" id="{{$x}}" class="form-control amount" value="{{$c['amount']}}" min="1"> 
                                <a href="{{ route('cart.remove', ['slug'=>$c['slug']])}}" class="">remover</a>
                            </td>
                            <td id="tdShipping"> receba até 20 de junho</td>
                                
                           
                            <td > 
                                R$ <input type="number"  name="price-{{$x}}" disabled value="{{$c['price']}}">
                                <input type="number" class="disabled"  name="originalPrice-{{$x}}" disabled value="{{$c['price']}}">
                            </td>
                            @php
                                $price = $c['price'] + $price;
                                $x += 1;
                            @endphp
                        </tr>
                        
                    @endforeach                        
                </tbody>
            </table>
        </div>
        <div class="col" id="summaryCart">
            <h2>Resumo</h2>
            <p>Valor: R$ {{$price}}</p>
            <p>{{count($cart)}} itens</p>
            <p>Entrega: R$ X</p>
            <p>Previsão de entrega: 20 de junho</p>
            <p>Valor total: R$ </p>

            <a href="{{ route('checkout.index')}}" class="btn btn-lg btn-success float-right">Concluir Compra</a>
            
        </div>
    
        <div class="col-md-12">
            <form action="" id="formCep" >
                <p>Calcular frete e prazo de entrega</p>
                <input type="text"  name="frete" id="frete">
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
        
        <!-- var price = `{{$cart[0]['price']}}`; 
        var price =  $("input[type=number][name=price-" + id + "]").val(); 
        *isso -->

@endsection 

@section('scripts')

    <script>
       

        $(".amount").click(function(){
            var id = $(this).attr("id"); 
            var amount = $("input[type=number][name=amount-" + id + "]").val();
            const price =  $("input[type=number][name=originalPrice-" + id + "]").val();
            var total = price * amount; 
            $("input[type=number][name=price-" + id + "]").val(total);

           
            
        });



    </script>

@endsection