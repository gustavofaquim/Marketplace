<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SlugTrait;

class Product extends Model
{
    use HasFactory;
    use SlugTrait;

    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];

    protected $casts = [
        'informacoes' => 'array'
    ];

    public function getThumbAttribute(){
        return $this->photos->first()->image;
    }

   

    
    /*
     * Relações entre tabelas
     */


    //Um produto pertece a uma loja (1 para N)
    public function store(){
        return $this->belongsTo(Store::class);
    }

    //Um produto tem muitas cateogiras (1N pra N)
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function photos(){
        return $this->hasMany(ProductPhoto::class);
    }
}
