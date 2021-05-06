<?php 

namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait SlugTrait{
    
     //Mutator 
     public function setNameAttribute($valor){
        $slug = Str::slug($valor);
        $matchs = $this->uniqueSlug($slug);
        
        $this->attributes['name'] = $valor;
        $this->attributes['slug'] = $matchs  ? $slug . '-'. $matchs : $slug;
    }

    public function uniqueSlug($slug){
        //Veriifca se já existe o mesmo slug no banco
        $matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();
        
        return $matchs;
    }

}