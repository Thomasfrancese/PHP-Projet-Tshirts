<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Creations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idLogo');
            $table->foreign('idLogo')->reference('id')->on('logos');
            $table->integer('idTshirt');
            $table->foreign('idTshirt')->reference('id')->on('tshirts');
            $table->integer('idUser');
            $table->foreign('idUser')->reference('id')->on('users');
            $table->timestamps();

        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creations');
    }
}
