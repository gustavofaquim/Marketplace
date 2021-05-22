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


    protected function validator(array $data)
    {   
       
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        
    }

    public function update(Request $request){
        $data = $request->all();
        
        $msg = '';
        $text = '';
        $user = auth()->user();
        

        empty($data['password']) ? $data['password'] = $user->password : $data['password'] = Hash::make($data['password']);
        

        if($user->cpf == $data['cpf']){
            if($user->update($data)){
              $msg = 'msg';
              $text = 'Usuário atualizado com sucesso';  
            }
            else{
                $msg = 'msg-warning';
                $text = 'Erro durante a atualização';  
            }
        }else{
            $msg = 'msg-warning';
            $text = 'Violação na integridade dos dados, o campo CPF não pode ser alterado!';  
        }
        return redirect( )->route('user.edit')->with($msg, $text);

    }
}
