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
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('event_id')->index();
            $table->uuid('asesi_id')->index();
            $table->uuid('asesor_id')->index()->nullable();
            $table->string('tujuan_asesmen');
            $table->string('ttd_asesi');
            $table->date('tgl_ttd_asesi');
            $table->string('ttd_admin')->nullable();
            $table->date('tgl_ttd_admin')->nullable();
            $table->enum('status', ['Menunggu Keputusan', 'Lulus', 'Tidak Lulus'])->default('Menunggu Keputusan');
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
