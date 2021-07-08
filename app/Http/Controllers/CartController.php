<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    
    public function index(){
        $cart = session()->has('cart') ? session()->get('cart') : [];
        
        //dd($cart);
        return view('cart',['cart' => $cart]);
    }

    
    public function add(Request $request){
        
       // $productData = $request->get('product');
        $productData = $request->all();

       /* $products = session()->get('cart');
        $productsSlugs = array_column($products, 'slug');

        if(in_array($product['slug'], $productsSlugs)){
            $products = $this->productIncrement($product['slug'], $product['amount'], $products);
            session()->put('cart',$products);
        }else{
            session()->push('cart', $product);   
        } */
        
        $product = Product::whereSlug($productData['slug']);

        if(!$product->count() || $productData['amount'] <= 0) return redirect()->route('home');

        $product = $product->first(['id','name','price', 'store_id'])->toArray();

        $product = array_merge($productData, $product);

        //Verificar se existe sessao para carrinho de produtos
        if(session()->has('cart')){ //Existindo a sessao, adiciona o produto na sessao
            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');

            if(in_array($product['slug'], $productsSlugs)){
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart',$products);
            }else{
                session()->push('cart', $product);  
            }
        }else{ //Não existindo, cria a sessao com o primeiro produto
            //$products[] = $product;
            $products = $product;
            session()->push('cart', $products);
        }

        //session()->push('cart', $product);
        //return redirect()->route('product.single', ['slug' => $product['slug']])->with('msg', 'Produto adicionado ao carrinho');
        
        $dataJson = [
            'status' => true,
            'message' => 'Produto adicionado ao carrinho!',
            'slug' => $product['slug']
        ]; 
        
        return response()->json([
            'data'=> $dataJson           
        ]); 

        
    }

    public function remove($slug){
        if(!session()->has('cart')){
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');

        $products = array_filter($products, function($line) use ($slug){
            return $line['slug'] != $slug;
        });

        session()->put('cart',$products);
        return redirect()->route('cart.index');
    }

    public function cancel(){
        session()->forget('cart');
        return redirect()->route('cart.index')->with('msg', 'Compra cancelada');

    }

    private function productIncrement($slug, $amount,$products){
        $products = array_map(function($line) use($slug, $amount){
            if($slug == $line['slug']){
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }
}