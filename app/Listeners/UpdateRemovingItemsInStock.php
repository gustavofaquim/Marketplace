<?php

namespace App\Listeners;

use App\Events\UserOrderedItems;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\ProductStockManagerService;

class UpdateRemovingItemsInStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserOrderedItems  $event
     * @return void
     */
    public function handle(UserOrderedItems $event)
    {
        (new ProductStockManagerService($event->userOrder))->removeProductFromStock();
    }
}


// Existir o disparar do Evento UserOrderedItems -> 
// UpdateRemovingItemsInStock removendo imtens da coluna in-stock dos produtos do pedido do usuario.

// Existir o disparar do Evento UserCancelledOrder -> 
// UpdateAddingBackImtensInStock, adiciona o item de volta ao estoque (compra cancelada, por exemplo).