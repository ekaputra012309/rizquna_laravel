<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id_payment');
            $table->string('id_booking');
            $table->string('pilih_konversi');
            $table->decimal('sar_idr', 10, 2);
            $table->decimal('sar_usd', 10, 2);
            $table->decimal('usd_idr', 10, 2);
            $table->decimal('hasil_konversi', 15, 2);
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
        Schema::dropIfExists('payments');
    }
}
