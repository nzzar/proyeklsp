<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSkemaAsesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skema_asesis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->index();
            $table->unsignedInteger('asesi_id')->index();
            $table->unsignedInteger('asesor_id')->index()->nullable();
            $table->string('ttd_asesor')->nullable();
            $table->string('tujuan_asesmen');
            $table->string('ttd_asesi');
            $table->date('tgl_ttd_asesi');
            $table->date('tgl_ttd_admin')->nullable();
            $table->enum('status', ['Menunggu Keputusan', 'Diterima', 'Tidak Diterima'])->default('Menunggu Keputusan');
            $table->enum('skema_status', ['Kompeten', 'Belum Kompeten'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('event_id')->references('id')->on('event');
            $table->foreign('asesi_id')->references('id')->on('asesis');
            $table->foreign('asesor_id')->references('id')->on('asesors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skema_asesis');
    }
}
