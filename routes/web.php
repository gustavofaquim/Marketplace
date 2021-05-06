<?php

use Illuminate\Support\Facades\Route;
use \App\Models\User;
use \App\Models\Product;
use \App\Models\Category;
use \App\Models\Store;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductPhotoController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[HomeController::class, 'index'])->name("home");
Route::get('/product/{slug}', [HomeController::class, 'single'])->name('product.single');
Route::get('/category/{slug}', ["App\Http\Controllers\CategoryController"::class, 'index'])->name('category.single');
Route::get('/store/{slug}', ["App\Http\Controllers\StoreController"::class, 'index'])->name('store.single');

// Carrinho de compras
Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add', [CartController::class, 'add'])->name('add');
    Route::get('remove/{slug}', [CartController::class, 'remove'])->name('remove');
    Route::get('cancel', [CartController::class, 'cancel'])->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/proccess', [CheckoutController::class, 'proccess'])->name('proccess');
    Route::get('/thanks', [CheckoutController::class, 'thanks'])->name('thanks');

    Route::post('/notification', [CheckoutController::class, 'notification'])->name('notification');
});

Route::get("my-orders",[UserOrderController::class, 'index'])->name('user.orders')->middleware('auth');

//Adimistradores do sistema
Route::group(["middleware" => ["auth", "acess.control.store.admin"]], function(){
    
    Route::prefix('admin')->name('admin.')->group(function(){
        /*Route::prefix('stores')->name('stores.')->group(function(){
            Route::get('/', [StoreController::class, 'index'])->name('index');
            Route::get('/create', [StoreController::class, 'create'])->name('create');
            Route::post('/store', [StoreController::class, 'store'])->name('store');
            Route::get('/{store}/edit', [StoreController::class, 'edit'])->name('edit');
            Route::post('/update/{store}', [StoreController::class, 'update'])->name('update');
            Route::get('/destroy/{store}', [StoreController::class, 'destroy'])->name('destroy');
            
        });*/
        Route::resource('stores', StoreController::class);
        Route::resource('products',ProductController::class);
        Route::resource('categories', CategoryController::class);

        
        Route::post('photos/remove', [ProductPhotoController::class, 'removePhoto'])->name('photo.remove');

        Route::get('orders/my', [OrdersController::class, 'index'])->name('orders.my');

        Route::get('notifications', [NotificationController::class, 'notifications'])->name('notifications.index');
        Route::get('notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read.all');
        Route::get('notifications/read/{id}', [NotificationController::class, 'read'])->name('notifications.read');

    });

    

});



Route::get('/model', function(){
    //$products = \App\Product::all();

    /*$user = new User();
    $user->name = 'Usuário Teste';
    $user->email = 'email@teste.com';
    $user->password = bcrypt('123456789');

    //return $user::all();
    return $user::paginate(10);*/

    /*
    
    //Mass Assignmet - Atribuição em massa
    $user::create([
        'name'=> 'Teste teste',
        'email'=> 'teste.teste@teste.com',
        'password'=> bcrypt('123456789')
    ]);*/


    //Como pegar a loja de um usuário
    //$user = User::find(4);

    //return "<pre>".$user->store->products."</pre>";

    //Criando uma loja
   /* $user = User::find(10);
    $store = $user->store()->create([
        'name'=> "Loja Teste",
        'description' => 'Loja Teste de produtos de informática',
        'mobile_phone'=> 'XX-XXXX-XXX',
        'phone'=> 'XXXXXXXXX',
        'slug'=> 'loja-teste'
    ]);

    dd($store);*/

    
    //Criando produto para uma loja
    /*$store = Store::find(31);
    
    $product = $store->products()->create([
        'name'=> "Notebook Dell",
        'description'=> "Core i5",
        'body'=> "Qualquer coisaaaa",
        'price'=> 2999,90,
        'slug'=> "notebook-dell",
    ]);

    dd($product);*/

    //Criar categoria
    /*$category = Category::create([
        'name'=>'Games',
        'description'=> null,
        'slug'=>'games'
    ]);

    $category = Category::create([
        'name'=>'Notebooks',
        'description'=> null,
        'slug'=>'notebooks'
    ]);

    return $category::all();*/

    // Adicionando categorias a um produto
    // attach adiciona e detach remove
    // sync adiciona todos do array, ou remove
    $product-> categories()->attach([2]);
    

});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('not', function(){
    //$user = User::find(20);
    //$user->notify(new \App\Notifications\StoreReceiveNewOrder());
    
    //$notifications = $user->notifications->first();
    //$notifications->markAsRead();

    

    //return $user->readNotifications->count();
    //return $user->unreadnotifications;
});
