<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPatientIdToChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
             $table->integer('patient_id');
             $table->integer('doctor_id');
             //$table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            //
            $table->dropColumn(['patient_id,doctor_id']);
        });
    }
}
