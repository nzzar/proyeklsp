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
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('event_id')->index();
            $table->uuid('skema_id')->index();
            $table->uuid('asesi_id')->index();
            $table->uuid('persyaratan_id')->index();
            $table->string('file');
            $table->enum('status', ['Sedang diperiksa', 'Memenuhi Syarat', 'Tidak Memenuhi Syarat'])->default('Sedang diperiksa');
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
