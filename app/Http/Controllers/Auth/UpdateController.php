<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\UserRegisteredEmail;

class UpdateController extends Controller
{
    
    
    public function edit(){
        
        $user = auth()->user();
        
        return view('auth.edit', ['user' => $user]);
    }

    public function update(Request $request){
        $data = $request->all();

        dd($data);
    }
}
