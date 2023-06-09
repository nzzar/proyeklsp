<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCeklisObservasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceklis_observasi', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('asesi_id')->index();
            $table->unsignedInteger('event_id')->index();
            $table->unsignedInteger('skema_id')->index();
            $table->unsignedInteger('unit_kompetensi_id')->index();
            $table->unsignedInteger('element_id')->index();
            $table->unsignedInteger('unjuk_kerja_id')->index();
            $table->boolean('kompeten')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('asesi_id')->references('id')->on('asesis');
            $table->foreign('event_id')->references('id')->on('event');
            $table->foreign('skema_id')->references('id')->on('skemas');
            $table->foreign('unit_kompetensi_id')->references('id')->on('unit_kompetensi');
            $table->foreign('element_id')->references('id')->on('element');
            $table->foreign('unjuk_kerja_id')->references('id')->on('unjuk_kerja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ceklis_observasi');
    }
}
