<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use \App\Models\Product;
use \App\Models\Store;
Use \App\Traits\UploadTrait;
use \App\Models\Category;

class ProductController extends Controller
{
    use UploadTrait; //Usa a Trait de Upload

    private $product;
    
    public function __contruct(Product $product){
       
        $this->product = $product; 
    }


    public function index()
    {
        //$products = $this->product->paginate(10);
        //$products = Product::paginate(10);
        $user = auth()->user();

        if(!$user->store()->exists()){
            return redirect()->route('admin.stores.index');
        }
        
        $userStore = $user->store;
        $products = $userStore->products()->paginate(10);
      
        return view('admin.products.index', ['products'=> $products]);
    }

   
    public function create()
    {
        $categories = Category::all(['id', 'name']);

        return view('admin.products.create', ['categories' => $categories]);
    }

   
    public function store(ProductRequest $request)
    {
      
       $data = $request->all();

       $categories = $request->get('categories', null);
      
       $data['price'] = formtPriceToDataBase($data['price']);  //Formatando preço para salvar no banco, função em helpers
       
       $store = auth()->user()->store; //Pegando a loja do usuário logado
       //dd($product = $store->products());
       
       $product = $store->products()->create($data);
       //dd($product);
       $product->categories()->sync($categories);


       if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'image');

            $product->photos()->createMany($images);
       }

       return redirect( )->route('admin.products.index')->with('msg', 'Produto salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$products = $this->product->find($id);
        $product = Product::findOrFail($id);
        
        $categories = Category::all(['id', 'name']);

        return view('admin.products.edit', ['product' => $product, 'categories'=> $categories ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $categories = $request->get('categories', null);

        //$product = $this->product->find($id);
        $product = Product::find($id);
        $product->update($data);

        if(!is_null($categories)){
            $product->categories()->sync($categories);
        }
    

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'image');

            $product->photos()->createMany($images);
       }

        return redirect( )->route('admin.products.index')->with('msg', 'Produto atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect( )->route('admin.products.index')->with('msg', 'Produto removido com sucesso');
    }


}
