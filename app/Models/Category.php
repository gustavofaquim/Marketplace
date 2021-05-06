<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SlugTrait;

class Category extends Model
{
    use HasFactory;
    use SlugTrait;

    protected $fillabe = ['name','description','slug'];
    protected $guarded = [];



    
    //Um categoria tem muitos produtos (N pra N)
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
