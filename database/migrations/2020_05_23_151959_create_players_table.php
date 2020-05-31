<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id') ;
            $table->timestamps();
            $table->string('name');
            $table->string('surname');
            $table->timestamp('birth_date')->nullable();
            $table->timestamp('death_date')->nullable();
            $table->string('club')->nullable();//TODO: create club migration
            $table->string('email')->unique()->nullable();
            $table->bigInteger('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
