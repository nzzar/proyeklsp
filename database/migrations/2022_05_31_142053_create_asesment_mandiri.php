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
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('asesi_id')->index();
            $table->uuid('event_id')->index();
            $table->uuid('skema_id')->index();
            $table->uuid('unit_kompetensi_id')->index();
            $table->uuid('element_id')->index();
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
