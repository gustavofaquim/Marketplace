<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Models\Category;
use \App\Http\Views\CategoryViewComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       //Compartilhando a variável categories para todas as views.
       $categories = Category::all(['name', 'slug']);
        
       //view()->share('categories', $categories);

       /*view()->composer(['welcome', 'single'], function($view) use($categories){
           $view->with('categoires',  $categories);
       }); */

       /*view()->composer('*', function($view) use($categories){
           $view->with('categories',  $categories);
       });*/

       view()->composer("layouts.front", CategoryViewComposer::class, "compose");
    }
}
