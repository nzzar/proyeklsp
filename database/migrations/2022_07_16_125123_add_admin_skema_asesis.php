<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminSkemaAsesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skema_asesis', function($table){
            $table->unsignedInteger('admin_id')->index()->nullable();

            $table->foreign('admin_id')->references('id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skema_asesis', function($table){
            $table->dropForeign(['admin_id']);
            $table->dropColumn(['admin_id']);
        });
    }
}
