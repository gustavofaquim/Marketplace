<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adress_user', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_address')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->timestamps();

            $table->foreign('id_address')->references('id')->on('adresses');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adress_user');
    }
}
