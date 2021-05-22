<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Product;
use \App\Models\Store;
use \App\Models\Category;


class HomeController extends Controller
{
  
 
    public function index()
    {   


        //session()->flush(); //encerrando as sessões
        //$userStore = auth()->user()->store;
        //$products = $userStore->products()->limit(8)->get();
        //$products = Product::limit(15)->orderBy('id','DESC')->get();
        //$stores = Store::limit(3)->get();
        //$stores = Store::limit(3)->orderBy('id','DESC')->get();
        
    
        $products = Product::paginate(20);
        
        $stores = Store::limit(3)->orderBy('id','DESC')->get();

        return view('welcome', ['products' => $products, 'stores' => $stores]);
    }

    public function single($slug){
        $product = Product::whereSlug($slug)->first();

        return view ('single',['product' => $product]);
    }
}
