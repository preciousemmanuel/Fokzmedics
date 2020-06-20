<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('name', 200);
            $table->decimal('price');
            $table->decimal('addon_price', 10, 3)->nullable();
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
        Schema::drop('tests');
    }

}
