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


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
       
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['string'],
        ]);
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $user = User::create([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role'    => array_key_exists('role', $data) ? $data['role']  : 'ROLE_USER', //ROLE_OWNER   ROLE_USER
        ]);

        //dd($user);
        
        $address = [
            'state' => $data['state'],
            'city' => $data['city'],
            'street' => $data['street'],
            'district' => $data['district'],
            'number' => $data['number'],
            'complement' => $data['complement'],
            //'reference_point' => $data['reference_point'],
            'zip_code' => $data['zip_code'],
        ];

        $user->addresses()->create($address);
        
       
        return $user;

        /*return User::create([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'state' => $data['state'],
            'city' => $data['city'],
            'street' => $data['street'],
            'district' => $data['district'],
            'complement' => $data['complement'],
            //'reference_point' => $data['reference_point'],
            'zip_code' => $data['zip_code'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role'    => array_key_exists('role', $data) ? $data['role']  : 'ROLE_USER', //ROLE_OWNER   ROLE_USER
        ]); */

       
    }

    protected function registered(Request $request, $user){
        $email = $user->email;
        Mail::to($email)->send(new UserRegisteredEmail($user));

        if($user->role == "ROLE_OWNER"){    
            return redirect()->route('admin.dashboard');
        }
         
        if(session()->has('cart') && $user->role == "ROLE_USER"){
            return redirect()->route('checkout.index');
        }else{
            return redirect()->route('home');
        }

        return null;
    }
}
