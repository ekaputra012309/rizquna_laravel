<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->increments('id_visa');
            $table->string('visa_id');
            $table->dateTime('tgl_visa');
            $table->integer('agent_id');
            $table->dateTime('tgl_keberangkatan');
            $table->decimal('jumlah_pax', 10, 2);
            $table->decimal('harga_pax', 10, 2);
            $table->decimal('total', 10, 2);
            $table->enum('status', ['Piutang', 'Lunas'])->default('Piutang');
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
        Schema::dropIfExists('visas');
    }
}
