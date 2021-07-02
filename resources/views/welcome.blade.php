@extends('layouts.front')

@section('content')
    <div class="row front" id="row">
        {{ $products->links() }}
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
        
        @endforeach
        {{ $products->links() }}

    </div>

    

@endsection
