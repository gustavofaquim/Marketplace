@extends('layouts.front')

@section('content')
    <div id="containerLoja" class="row front">

        <div class="col-md-4">
            @if($store->logo)
                <img src="{{asset('storage/'.$store->logo)}}" alt="{{$store->name}}" class="img-fluid">
            @else
                <img src="https://via.placeholder.com/400X150.png?text=logo" alt="Loja sem logo" class="img-fluid">
            @endif
        </div>
        <div class="col-md-8">
            <h2>{{$store->name}}</h2>
            <p>{{$store->description}}</p>
            <p>
                <strong>Contatos:</strong>
                <span>{{$store->phone}}</span> | <span>{{$store->mobile_phone}}</span>
            </p>
        </div>


        <div class="col-md-12">
            <h3>Produtos desta loja:</h3>
            <hr>
        </div>
        @forelse($store->products as $key => $product)
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
{{--           <div class="col-md-4">--}}
{{--           --}}
{{--            <div class="card" style="width:95%;">--}}
{{--                    @if($product->photos->count())--}}
{{--                        <img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="" class="card-img-top">--}}
{{--                    @else--}}
{{--                        <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">--}}
{{--                    @endif--}}
{{--                --}}
{{--                    <div class="card-body">--}}
{{--                        <h2 class="car-title"> {{$product->name}}</h2>--}}
{{--                        <p class="card-text">{{ $product->description}}</p>--}}
{{--                        <h3>R$ {{number_format($product->price, '2',',','.')}}</h3>--}}
{{--                        <a href="{{route('product.single', ['slug'=> $product->slug])}}" class="btn btn-success">Ver produto</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--           </div>--}}
{{--           @if(($key + 1) % 3 == 0) </div><div class="row front">  @endif--}}

        @empty
            <div class="col-md-12">
                <h3 class="alert alert-warning"> Nenhum produto encontrado para esta Loja!</h3>
            </div>
        @endforelse

    </div>


@endsection
