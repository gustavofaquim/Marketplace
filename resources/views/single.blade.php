@extends('layouts.front')

@section('content')

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
                <h2>{{ $product->name }}</h2>

                <p>{{$product->description}}</p>

                @if($product->in_stock > 0)
                    <h3> R$ {{number_format($product->price, '2',',','.')}}</h3>
                @else
                    <h4>Produto indisponível</h4>
                @endif
                <span>Loja: {{$product->store->name}}</span>

                <form action="{{route('cart.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">

                    @if($product->in_stock > 0)
                    <div class="form-group">
                        <label for="">Quantidade</label>
                        <input type="number" name="product[amount]" class="form-control col-md-2" value="1" min="1">
                    </div>
                    <button class="btn btn-lg btn-danger">Comprar</button>@endif
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

    <br><br><br><br><br><br><br><br><br><br><br> <br><br><br><br><br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-sm" id="colunaProduto">
            @if($product->photos->count())
               
                <img id="imgProduto" src="{{asset('storage/'.$product->thumb)}}" alt="" class="card-img-top thumb">
                <!-- <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top thumb"> -->

                <div class="row">
                @foreach($product->photos as $photo)
                    <div class="col-4">
                        <img src="{{asset('storage/'.$photo->image)}}" alt="" class="img-fluid img-small">
                    </div>
                @endforeach

            @else
                <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
            @endif
            </div>
        </div>

        <div class="col-sm">
            <div class="col-md-12">
                <h2>{{ $product->name }}</h2>

                <p>{{$product->description}}</p>

                @if($product->in_stock > 0)
                    <h3> R$ {{number_format($product->price, '2',',','.')}}</h3>
                @else
                    <h4>Produto indisponível</h4>
                @endif
                <span>Loja: {{$product->store->name}}</span>
            </div>
            <hr>
            <div class="product-add col-md-12">
                <form action="{{route('cart.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">

                    @if($product->in_stock > 0)
                    <div class="form-group">
                        <label for="">Quantidade</label>
                        <input type="number" name="product[amount]" class="form-control col-md-2" value="1" min="1">
                    </div>
                    <button class="btn btn-lg btn-danger">Comprar</button>@endif
                </form>
            </div>
        </div>
    </div>

    <div class="row" id="infoProduto">
        <div class="col-12" id="colunaInfoProduto">
            <h3 class="titulo-info">Informações do produto</h3>
            <hr>
            {{$product->body}}
        </div>

        <div class='col-12'>
            


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
