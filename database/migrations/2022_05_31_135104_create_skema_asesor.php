<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSkemaAsesor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skema_asesor', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->index();
            $table->unsignedInteger('asesor_id');
            $table->string('surat_tugas')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('event_id')->references('id')->on('event');
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
        Schema::dropIfExists('skema_asesor');
    }
}
