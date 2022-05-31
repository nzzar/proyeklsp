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
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('user_id')->index();
            $table->uuid('prodi_id')->index();
            $table->string('nim')->index();
            $table->string('name')->index();
            $table->string('nik')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('tmpt_lahir')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['p', 'l'])->nullable();
            $table->string('address')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('kebangsaan')->nullable();
            $table->string('kualifikasi_pendidikan')->nullable();
            $table->string('profile')->nullable();
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
