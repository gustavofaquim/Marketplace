<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Store;
use \App\Models\User;

class DashboardController extends Controller
{
    
    public function index(){

        $store = auth()->user()->store;
         

        return view('admin.dashboard',['store'=>$store]);
    }

}
