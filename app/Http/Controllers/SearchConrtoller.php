<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchConrtoller extends Controller
{
    public function search(Request $request){
        
        $search = $request->a;
        
        if(!empty($search)){

            $results = Product::where([
                ['name', 'like', '%'.$search.'%']
            ])->get();

            return view('search', ['results' => $results, 'search' => $search]);
        }else{
            return redirect()->route('home');
        }
    }
}
