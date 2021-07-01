@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Pedidos recebidos</h2>
        </div>

        <div class="col-md-12">
            @forelse($orders as $key => $order)
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                Pedido nº : {{$order->reference}}
                            </button>
                        </h5>
                        </div>

                        <div id="collapse{{$key}}" class="collapse @if($key==0)show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                @foreach(filterItemsByStoreId($order->items, auth()->user()->store->id) as $item)
                                    <li>
                                    {{$item['name']}} | R$ {{number_format(($item['price'] * $item['amount']),2,',','.')}}
                                    <br>
                                    Quantidade pedida: {{$item['amount']}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        </div>
                    </div>
            @empty
                <div class="alert alert-warning">Nehum pedido recebido</div>
            @endforelse

            </div>
            
            <div class="col-md-12">
                {{$orders->links()}}
            </div>


        </div>
    </div>
@endsection