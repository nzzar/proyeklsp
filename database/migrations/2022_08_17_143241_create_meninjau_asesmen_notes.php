<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMeninjauAsesmenNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meninjau_asesmen_notes', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('skema_asesi_id')->index();
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
        Schema::dropIfExists('meninjau_asesmen_notes');
    }
}
