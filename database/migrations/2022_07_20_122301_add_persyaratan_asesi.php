<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersyaratanAsesi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asesment_mandiri', function($table){
            $table->unsignedInteger('persyaratan_asesi_id')->index()->nullable();

            $table->foreign('persyaratan_asesi_id')->references('id')->on('persyaratan_asesi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asesment_mandiri', function($table){
            $table->dropForeign(['persyaratan_asesi_id']);
            $table->dropColumn(['persyaratan_asesi_id']);
        });
    }
}
