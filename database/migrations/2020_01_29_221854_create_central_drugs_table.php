<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentralDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('central_drugs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('generic_name', 150);
            $table->string('trade_name', 150);
            $table->decimal('price');
            $table->string('strength');
            $table->string('dosage_form', 255);
            $table->string('tablet_type', 255);
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('central_drugs');
    }
}
