<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use \App\Models\Store;
use \App\Models\User;
use Storage;
Use \App\Traits\UploadTrait;

class StoreController extends Controller
{
    
    use UploadTrait; //Usa a Trait de Upload
    
    public function __construct(){
       $this->middleware('user.has.store')->only(['create','store']);  //Aplicando o middleare criando apenas para o create e store 
    }
    
    public function index(){
        //$stores = Store::all();
        //$stores = Store::paginate(10);
        $store = auth()->user()->store;
        //dd(auth()->user()->store);                

        return view('admin.stores.index',['store'=>$store]);
    }

    public function create(){

        $users = User::all(['id','name']);

        return view('admin.stores.create', ['users'=>$users]);
    }

    public function store(StoreRequest $request){

        /*$store = new Store();
        $store->name = $request->name;
        $store->description = $request->description;
        $store->phone = $request->phone;
        $store->mobile_phone = $request->mobile_phone;
        $store->phone = $request->phone;
        $store->slug = $request->slug;*/

        
        $data = $request->all();  //Pegando todos os dados enviados via request
        $user = auth()->user();  //Pegando o usuario logado
        
        if($request->hasFile('logo')){
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store = $user->store()->create($data); //Criando loja para o usuário logado

        return redirect( )->route('admin.stores.index')->with('msg', 'Loja salva com sucesso');
    }


    public function edit($store){
        $store = Store::find($store);
        
        return view('admin.stores.edit', ['store'=> $store]);
    }

    public function update(StoreRequest $request, $store){
        $data = $request->all();

        $store = Store::find($store);

        //Chamada para o metodo de upload de fotos
        if($request->hasFile('logo')){
            if(Storage::disk('public')->exists($store->logo)){
                Storage::disk('public')->delete($store->logo);
            }
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store->update($data);

        return redirect()->route('admin.stores.index')->with('msg', 'Loja atualizada com sucesso');
    }

    public function destroy($store){

        $store = Store::find($store);
        $store->delete();

        return redirect()->route('admin.stores.index')->with('msg', 'Loja removida com sucesso');

    }
}
