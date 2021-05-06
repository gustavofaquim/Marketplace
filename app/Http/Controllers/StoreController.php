<?php

namespace App\Http\Controllers;
use App\Models\Store;

use Illuminate\Http\Request;

class StoreController extends Controller
{   

    private $store;
    
    public function __construct(Store $store){
        $this->store = $store;
    }

    public function index($slug){
        $store = $this->store->whereSlug($slug)->first();
        //dd($store);
        return view('store', ['store' => $store]);
    }
}
