<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_product', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $$table->integer('product_id')->unsigned();
            $table->integer('discount_id')->unsigned();
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); 
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade'); 
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_product');
    }
}
