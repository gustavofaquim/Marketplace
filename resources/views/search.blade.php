@extends('layouts.front')

@section('content')

<div class="row front">
    <div class="col-md-12">
        <h2>Foram encontrados {{ $results->count() }} resultados com o termo buscado: "<span>{{$search}}</span>"</h2>
    </div>
        @foreach($results as $key => $result)
           <div class="col-md-3"> 
           <a href="{{route('product.single', ['slug'=> $result->slug])}}" class="links">
                <div class="card card-products">
                        @if($result->photos->count())
                            <img src="{{asset('storage/'. $result->thumb)}}" alt="" class="card-img-top img-fluid">
                        @else
                            <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top img-fluid">
                        @endif
                    
                        <div class="card-body">
                            <h2 class="car-title"> {{$result->name}}</h2>
                            <!-- <p class="card-text">{{ $result->description}}</p> -->
                            <h3 class="price">R$ {{number_format($result->price, '2',',','.')}}</h3>
                        </div>
                </div>
            </a>
           </div>
           @if(($key + 1) % 4 == 0) </div><div class="row front">  @endif
        @endforeach
    
    </div>

@endsection 