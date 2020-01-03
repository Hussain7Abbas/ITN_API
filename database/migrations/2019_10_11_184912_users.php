<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('idUs', 10);
            $table->string('name', 20)->unique();
            $table->bigInteger('phone');
            $table->boolean('gender');
            $table->string('address', 50);
            $table->string('XM', 30);
            $table->string('TNFX', 30);
            $table->string('joinDay', 20);
            $table->string('joinDate', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
