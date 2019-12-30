<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Signals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signals', function (Blueprint $table) {
            $table->increments('idSi');
            $table->boolean('action');
            $table->string('pairs', 6);
            $table->decimal('tp', 5, 5);
            $table->decimal('sl', 5, 5);
            $table->decimal('lot', 2, 2);
            $table->string('date', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signals');
    }
}
