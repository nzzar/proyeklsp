<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMeninjauInstrument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meninjau_instrument', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('skema_asesi_id')->index();
            $table->string('kegiatan_asesmen');
            $table->boolean('result')->default(false);
            $table->string('komentar')->nullable();
            $table->timestamps();

            $table->foreign('skema_asesi_id')->references('id')->on('skema_asesis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meninjau_instrument');
    }
}
