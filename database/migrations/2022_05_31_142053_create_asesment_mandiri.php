<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAsesmentMandiri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesment_mandiri', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('asesi_id')->index();
            $table->unsignedInteger('event_id')->index();
            $table->unsignedInteger('skema_id')->index();
            $table->unsignedInteger('unit_kompetensi_id')->index();
            $table->unsignedInteger('element_id')->index();
            $table->boolean('kompeten')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('asesi_id')->references('id')->on('asesis');
            $table->foreign('event_id')->references('id')->on('event');
            $table->foreign('skema_id')->references('id')->on('skemas');
            $table->foreign('unit_kompetensi_id')->references('id')->on('unit_kompetensi');
            $table->foreign('element_id')->references('id')->on('element');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asesment_mandiri');
    }
}
