<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJamaahTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jamaah', function (Blueprint $table) {
            $table->id();
            $table->integer('nik');
            $table->string('nama');
            $table->string('alamat');
            $table->text('phone');
            $table->integer('passpor');
            $table->integer('dp')->nullable();
            $table->date('tgl_berangkat');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('cabang_id')->references('id')->on('cabang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jamaah');
    }
}
