<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id('order_id', 11);
            $table->integer('order_user_id', false, false, 11)->nullable();   
            $table->integer('order_brg_id', false, false, 11)->nullable();
            $table->integer('order_brg_satuan_id', false, false, 11)->nullable();
            $table->integer('order_brg_lokasi_id', false, false, 11)->nullable();
            $table->integer('order_brg_jml', false, false, 11)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
