@extends('layouts.front')

@section('content')
    <h3>{{ $product->name }}</h3>

    <div class="row" id="blocoProduto">
            @if($product->photos->count())

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
                    <p>em até 10x sem juros.</p>
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

                    
                    
                </form>
                <button class="btn btn-lg btn-warning" id="1" onclick="type_link(this.id)" >Adicionar ao carrinho</button> <br>
                <button class="btn btn-lg btn-danger" id="2" onclick="type_link(this.id)" >Comprar Agora</button> 
                
            </div>
    </div>
    <div class="row" id="imagePreview">
        <p>Veja mais fotos do produto</p>
        <div class="col" id="colunaImgs">
            @foreach($product->photos as $photo)
                    <img src="{{asset('storage/'.$photo->image)}}" alt="" class="img-fluid img-small">
            @endforeach
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

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>

        let thumb = document.querySelector('img.thumb');
        let small = document.querySelectorAll('img.img-small');

        small.forEach(function(el){
            el.addEventListener('click', function(){
                thumb.src = el.src;
            });
        });

    </script>

    <script>

        let name =  `{{$product->name}}`;
        let price =  `{{$product->price}}`;
        let slug =  `{{$product->slug}}`;
        let photo = `{{$product->thumb}}`;
        let amount =  1;
        const urlProccess = `{{route('cart.add')}}`;
        const csrf = '{{csrf_token()}}';

        const data = {
            name: name,
            photo: photo,
            price: price,
            slug: slug,
            amount: amount,
            _token: csrf
        }

        function type_link(clicked_id){
            if(clicked_id == "1"){
                data.link = "single";
            }else{
                data.link = "cart";
            }

            enviar();
        }   

        function enviar(){
            $.ajax({
                type: 'POST',
                url: urlProccess,
                data: data,
                dataType: 'json',
                success: function(res) { 
                    /*let cart = `{{route("cart.index")}}`; 
                    let single = `{{route("product.single", ["slug" => "$product->slug"])}}`;
                    
                    //alert(res.data.message);
                    
                    toastr.success(res.data.message, 'Sucesso');
                    window.location.assign(data.link === 'cart' ? cart : single); */

                    const link = "";
                    if(data.link === 'single'){
                        toastr.success(res.data.message, 'Sucesso');
                    }else{
                        window.location.assign(`{{route("cart.index")}}`); 
                    }
                   
                   
                },
            });
        }


    </script>


  

@endsection
