<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUnjukKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unjuk_kerja', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('element_id')->index();
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('unjuk_kerja');
    }
}
