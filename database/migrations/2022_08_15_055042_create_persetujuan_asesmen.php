<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePersetujuanAsesmen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persetujuan_asesmen', function (Blueprint $table) {
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('skema_asesi_id')->index();
            $table->boolean('portofolio')->default(false);
            $table->boolean('observasi_langsung')->default(false);
            $table->boolean('tes_tulis')->default(false);
            $table->boolean('tes_lisan')->default(false);
            $table->boolean('wawancara')->default(false);
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
        Schema::dropIfExists('persetujuan_asesmen');
    }
}
