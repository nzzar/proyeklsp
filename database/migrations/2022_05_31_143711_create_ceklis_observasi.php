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
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('asesi_id')->index();
            $table->uuid('event_id')->index();
            $table->uuid('skema_id')->index();
            $table->uuid('unit_kompetensi_id')->index();
            $table->uuid('element_id')->index();
            $table->uuid('unjuk_kerja_id')->index();
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
