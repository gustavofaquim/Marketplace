@extends('layouts.front')

@section('content')
    <h3>{{ $product->name }}</h3>
    <div class="row" id="blocoProduto">
            @if($product->photos->count())
                <div class="col colunaProduto" id="colunaImgs">
                    @foreach($product->photos as $photo)
                        <div class="col-4">
                            <img src="{{asset('storage/'.$photo->image)}}" alt="" class="img-fluid img-small">
                        </div>
                    @endforeach
                </div>

                <div class="col-6 colunaProduto">
                    <img id="imgProduto" src="{{asset('storage/'.$product->thumb)}}" alt="" class="card-img-top thumb">
                </div>

            @else
                <div class="col-6 colunaProduto" id="">
                    <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                </div>
            @endif
            
            <div class="col colunaProduto" id="">
                <p>{{$product->description}}</p>

                @if($product->in_stock > 0)
                    <h3> R$ {{number_format($product->price, '2',',','.')}}</h3>
                @else
                    <h4>Produto indisponível</h4>
                @endif
                <span>Vendido e entregue por: {{$product->store->name}}</span>

                <form action="">
                    <label for="frete">Calcular frete</label> <br>
                    <input type="text" name="frete" id="frete">
                    <button>calcular</button>

                    <p>Prazo e valor de entrega</p>

                </form>
                <br>
                <form action="{{route('cart.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                    <input type="hidden" name="product[amount]" value="1">

                   <!-- @if($product->in_stock > 0)
                    <div class="form-group">
                        <label for="">Quantidade</label>
                        <input type="number" name="product[amount]" class="form-control col-md-2" value="1" min="1">
                    </div>
                    <button class="btn btn-lg btn-danger">Comprar</button>
                    @endif -->

                    <button class="btn btn-lg btn-warning">Adicionar ao carrinho</button>  <br> <br>

                    <button class="btn btn-lg btn-danger">Comprar Agora</button> 
                    
                </form>
            </div>
    </div>

    <div class="container-fluid" id="infoProduto">
        <h3 class="titulo-info">Informações do produto</h3>
        <hr>
        <p>{{$product->name}}</p>
        <p>{{$product->body}}</p>

        @if($product->information != "")
            <table class="table table-striped">
                <tbody>
                 @foreach($product->information as $information){
                    <tr>
                        <td>{{$information}}</td>
                    </tr>
                }
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    </div> 

@endsection

@section('scripts')

    <script>

        let thumb = document.querySelector('img.thumb');
        let small = document.querySelectorAll('img.img-small');

        small.forEach(function(el){
            el.addEventListener('click', function(){
                thumb.src = el.src;
            });
        });


    </script>

@endsection
