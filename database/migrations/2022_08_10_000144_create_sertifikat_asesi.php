<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSertifikatAsesi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sertifikat_asesi', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('skema_asesi_id')->index();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('sertifikat');
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
        Schema::dropIfExists('sertifikat_asesi');
    }
}
