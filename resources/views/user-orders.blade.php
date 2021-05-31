@extends('layouts.front')

@section('content')
    <div class="col row">
        <div class="col-md-12">
            <h2>Meus Pedidos</h2>
        </div>

    
            <div class="col-md-12">
            @forelse($userOrders as $key => $order)

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                            Pedido nº : {{$order->reference}}
                        </button>
                        </h2>
                        <div id="collapse{{$key}}" class="accordion-collapse collapse @if($key==0)show @endif" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @php $items = $order->items; @endphp
                                @foreach($items as $item)
                                    <li>
                                    {{$item['name']}} | R$ {{number_format(($item['price'] * $item['amount']),2,',','.')}}
                                    <br>
                                    Quantidade pedida: {{$item['amount']}}
                                    </li>
                            @endforeach
                            
                        </div>
                    </div>
                </div> <br><br>
            @empty
                <div class="alert alert-warning">Nehum pedido recebido</div>
            @endforelse
            
            </div>
            
            <div class="col-md-12">
                {{$userOrders->links()}}
            </div>


        </div>
    </div>
@endsection