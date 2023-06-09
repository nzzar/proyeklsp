<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCeklisObservasiResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceklis_observasi_result', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('skema_asesi_id')->index();
            $table->string('unit_kompetensi');
            $table->boolean('demonstrasi')->default(false);
            $table->boolean('portofolio')->default(false);
            $table->boolean('pihak_ketiga')->default(false);
            $table->boolean('wawancara')->default(false);
            $table->boolean('lisan')->default(false);
            $table->boolean('tertulis')->default(false);
            $table->boolean('proyek')->default(false);
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
        Schema::dropIfExists('ceklis_observasi_result');
    }
}
