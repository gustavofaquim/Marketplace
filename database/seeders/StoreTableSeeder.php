<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use \App\Models\Product;


class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = Store::all();
        
        foreach($stores as $store){
            
            $store->products()->save(Product::factory()->make());

            /*$products = Product::factory()
                ->count(30)
                ->has(Product::factory())
                ->create();*/
        } 
    
    }
}
