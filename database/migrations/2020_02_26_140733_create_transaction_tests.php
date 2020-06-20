<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_tests', function (Blueprint $table) {
            $table->bigIncrements('id',true);
            $table->string('trans_ref');
            $table->decimal('amount',10,2);
            $table->integer('book_id');
            $table->integer('patient_id');
            $table->integer('lab_id');
            $table->integer('doctor_id');
            $table->string('address');
            $table->integer('status');
            $table->boolean('delivery');
            $table->string('complainType');
            $table->timestamp('complainDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_tests');
    }
}
