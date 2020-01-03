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
            $table->float('tp', 10, 5);
            $table->float('sl', 10, 5);
            $table->float('lotXM');
            $table->float('lotTNFX');
            $table->boolean('status');
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
