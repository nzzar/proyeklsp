<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateElement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('unit_kompetensi_id')->index();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('unit_kompetensi_id')->references('id')->on('unit_kompetensi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('element');
    }
}
