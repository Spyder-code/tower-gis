<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opds', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('singkatan_nama');
            $table->string('alamat');
            $table->string('kecamatan');
            $table->string('kode_pos');
            $table->string('telpon');
            $table->string('email');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('controller')->nullable();
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
        Schema::dropIfExists('opds');
    }
}
