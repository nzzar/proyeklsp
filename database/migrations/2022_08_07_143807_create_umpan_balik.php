<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUmpanBalik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umpan_balik', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('skema_asesi_id')->index();
            $table->string('komponen');
            $table->boolean('hasil')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('umpan_balik');
    }
}
