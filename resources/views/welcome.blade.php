@extends('layouts.front')

@section('content')
    <div class="row front" id="row">
        
        <div id="bannerPrincipal">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" id="indicadorSlide" class="active"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('assets/img/no-photo.jpg')}}" alt="Primeiro Slide">
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
            </div>
        </div>


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
