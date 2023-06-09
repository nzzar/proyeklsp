<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAssesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('asesis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('prodi_id')->index();
            $table->string('nim')->index();
            $table->string('name')->index();
            $table->string('nik')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('house_phone')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('tmpt_lahir')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['p', 'l'])->nullable();
            $table->string('address')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('kebangsaan')->nullable();
            $table->string('kualifikasi_pendidikan')->nullable();
            $table->string('profile')->nullable();
            $table->string('office')->nullable();
            $table->string('position')->nullable();
            $table->string('office_address')->nullable();
            $table->string('kode_pos_office')->nullable();
            $table->boolean('is_filled')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('prodi_id')->references('id')->on('prodis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asesis');
    }
}
