<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatakuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataku', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('source_id');
            $table->string('crew');
            $table->string('dest_id');
            $table->string('lat');
            $table->string('longitude');
            $table->string('message');
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
        Schema::dropIfExists('dataku');
    }
}
