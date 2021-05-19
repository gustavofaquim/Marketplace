@extends('layouts.front')

@section('content')
    <div class="row front">
        <div class="col-md-12">
            <h2>{{$category->name}}</h2>
        </div>
        
        @forelse($category->products as $key => $product)
           <div class="col-md-4">
           
            <div class="card" style="width:95%;">
                    @if($product->photos->count())
                        <img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="" class="card-img-top">
                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                    @endif
                
                    <div class="card-body">
                        <h2 class="car-title"> {{$product->name}}</h2>
                        <p class="card-text">{{ $product->description}}</p>
                        <h3>R$ {{number_format($product->price, '2',',','.')}}</h3>
                        <a href="{{route('product.single', ['slug'=> $product->slug])}}" class="btn btn-success">Ver produto</a>
                    </div>
                </div>
           </div>
           @if(($key + 1) % 3 == 0) </div><div class="row front">  @endif
       
        @empty
            <div class="col-md-12"> 
                <h3 class="alert alert-warning"> Nenhum produto encontrado para esta cateogria!</h3>
            </div>
        @endforelse
    
    </div>


@endsection 