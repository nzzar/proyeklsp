<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('skema_id')->index();
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['Draft','Waiting', 'Approved', 'Unapproved']);
            $table->integer('qty');
            $table->string('tuk');
            $table->string('desc')->nullable();
            $table->boolean('active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('skema_id')->references('id')->on('skemas');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
}
