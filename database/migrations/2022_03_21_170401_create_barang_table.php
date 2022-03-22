<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('brg_id', 11);
            $table->string('brg_nama', 250)->nullable();   
            $table->integer('brg_status_id', false, false, 11)->nullable();
            $table->integer('brg_stok', false, false, 11)->nullable();
            $table->integer('brg_satuan_id', false, false, 11)->nullable();
            $table->integer('brg_lokasi_id', false, false, 11)->nullable();
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
        Schema::dropIfExists('barang');
    }
}
