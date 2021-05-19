<php

namespace App\Services;

use App\Models\UserOrder;

class ProductStockManagerService{

    public function __construct(Userorder $userOrder){
        $this->userOrder = $userOrder;
    }
}