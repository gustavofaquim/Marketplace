<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchConrtoller extends Controller
{
    public function search(Request $request){
        $search = $request->search;
        
        dd($search);

    }
}
