<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;

    //protected $fillable = ['reference', 'pagseguro_status', 'pagseguro_code', 'store_id', 'items'];
    protected $fillable = ['reference', 'pagseguro_status', 'pagseguro_code', 'items'];

    public function user(){
        return $this->belongsTo(User::class);
    }


    //Um pedido pertence a um único usuário
    public function store(){
        return $this->belongsTo(Store::class);
    }
    
    public function stores(){                      //Nome da tabela //Nome da chave
        return $this->belongsToMany(Store::class, 'order_store', 'order_id');
    }
}
