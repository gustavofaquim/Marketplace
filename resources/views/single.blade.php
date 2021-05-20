@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-6" id="colunaProduto">
            @if($product->photos->count())
<!--                --><?php
//                    echo "<pre>";
//                    print_r($product->thumb);
//                     exit;
//              ?>
                <img src="{{asset('storage/'.$product->thumb)}}" alt="" class="card-img-top thumb">
{{--                <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top thumb">--}}

                <div class="row" style="margin-top:20px;">
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

        <div class="col-6">
            <div class="col-md-12">
                <h2>{{ $product->name }}</h2>

                <p>{{$product->description}}</p>

                <h3> R$ {{number_format($product->price, '2',',','.')}}</h3>

                <span>Loja: {{$product->store->name}}</span>
            </div>
            <hr>
            <div class="product-add col-md-12">
                <form action="{{route('cart.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">

                    <div class="form-group">
                        <label for="">Quantidade</label>
                        <input type="number" name="product[amount]" class="form-control col-md-2" value="1" min="1">
                    </div>
                    <button class="btn btn-lg btn-danger">Comprar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            {{$product->body}}
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
