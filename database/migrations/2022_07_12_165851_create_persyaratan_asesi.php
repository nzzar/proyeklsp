<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePersyaratanAsesi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persyaratan_asesi', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('event_id')->index();
            $table->unsignedInteger('skema_id')->index();
            $table->unsignedInteger('asesi_id')->index();
            $table->unsignedInteger('persyaratan_id')->index();
            $table->string('file');
            $table->enum('status', ['Sedang diperiksa', 'Memenuhi Syarat', 'Tidak Memenuhi Syarat'])->default('Sedang diperiksa');
            $table->string('desc')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('skema_id')->references('id')->on('skemas');
            $table->foreign('persyaratan_id')->references('id')->on('persyaratan_skema');
            $table->foreign('asesi_id')->references('id')->on('asesis');
            $table->foreign('event_id')->references('id')->on('event');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persyaratan_asesi');
    }
}
