<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SlugTrait;
use App\Notifications\StoreReceiveNewOrder;

class Store extends Model
{
    use HasFactory;
    use SlugTrait;

    protected $fillable = ['name', 'description','cnpj', 'phone', 'mobile_phone', 'slug', 'logo'];


    // A loja pertecem a um usuário (1 pra 1)
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Uma loja possui vários produtos (1 pra N)
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function orders(){                         //Nome da tabela //Ligações
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }


    
    public function notifyStoreOwners(array $storesId = []){
        //Retorna todas as lojas que estiverem dentro do array
        $stores = Store::whereIn('id', $storesId)->get();

        return $stores->map(function($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder());
    }
 }

