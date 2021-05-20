@extends('layouts.front')

@section('content')
    <div class="row front" id="row">
        @foreach($products as $key => $product)
           <div class="col-md-3" id="blocoHome">
           <a href="{{route('product.single', ['slug'=> $product->slug])}}" class="links">
                <div class="card card-products mr-3">
                        @if($product->photos->count())
                            <img src="{{asset('storage/'. $product->thumb)}}" alt="" class="card-img-top img-fluid">
                        @else
                            <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top img-fluid">
                        @endif

                        <div class="card-body">
                            <h2 class="car-title"> {{$product->name}}</h2>
                            <!-- <p class="card-text">{{ $product->description}}</p> -->
                            <h3 class="price">R$ {{number_format($product->price, '2',',','.')}}</h3>
                        </div>
                </div>
            </a>
           </div>
{{--           @if(($key + 1) % 4 == 0) </div><div class="row front">  @endif--}}
        @endforeach

    </div>

    @if($stores->count() > 0)
        <div class="row">
        <div class="col-12">
            <h2>Lojas Destaque</h2>
            <hr>
        </div>
            @foreach($stores as $store)
                <div class="col-4" id="blocoLoja">
                @if($store->logo)
                        <img src="{{asset('storage/'.$store->logo)}}" alt="{{$store->name}}" class="img-fluid">
                    @else
                        <img src="https://via.placeholder.com/400X150.png?text=logo" alt="Loja sem logo" class="img-fluid">
                @endif
                    <h3 class="titleLoja">{{$store->name}}</h3>
                    <p>{{$store->description}}</p>
                    <a id="botaoLoja" href="{{ route('store.single', ['slug' => $store->slug])}}" class="btn btn-sm-success">Ver Loja</a>
                </div>
            @endforeach
        </div>
    @endif

@endsection
