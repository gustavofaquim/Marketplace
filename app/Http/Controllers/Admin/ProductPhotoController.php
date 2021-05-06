<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use \App\Models\ProductPhoto;

class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request){
        
        //Remover os arquivos
        $photoName = $request->get('photoName');
        if(Storage::disk('public')->exists($photoName)){ // Verifica se o arquivo existe na pasta
            Storage::disk('public')->delete($photoName);  //Deleta o arquivo
        }

        //Remover imgem do banco

        $removePhoto = ProductPhoto::where('image', $photoName);
        $productId = $removePhoto->first()->product_id;
        $removePhoto->delete();

        return redirect()->route('admin.products.edit', ['product'=> $productId])->with('msg', 'Imagem removida com sucesso');
    }
}
