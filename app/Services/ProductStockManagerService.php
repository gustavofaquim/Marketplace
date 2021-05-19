<?php

namespace App\Services;

use App\Models\UserOrder;
use App\Models\Product;

class ProductStockManagerService{

    private $userOrder;

    public function __construct(Userorder $userOrder){
        $this->userOrder = $userOrder;
    }

    public function removeProductFromStock(){
        
        foreach($this->userOrder->items as $item){
            Product::find($item['id'])->decrement('in_stock', $item['amount']);
        }
    }

    public function addInProductInStock(){

        foreach($this->userOrder->items as $item){
            Product::find($item['id'])->increment('in_stock', $item['amount']);
        }

    }
}