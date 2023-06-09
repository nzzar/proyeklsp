<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUnitKompetensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_kompetensi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('skema_id')->index();
            $table->string('kode');
            $table->string('judul');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('skema_id')->references('id')->on('skemas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_kompetensi');
    }
}
