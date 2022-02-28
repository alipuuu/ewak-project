<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataikan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_ikan');
            $table->string('jenis_ikan');
            $table->string('harga_ikan');
            $table->string('stock_ikan');
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
        Schema::dropIfExists('dataikan');
    }
}
