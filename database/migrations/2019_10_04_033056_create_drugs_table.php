<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDrugsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drugs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('generic_name', 150);
			$table->string('trade_name', 150);
			$table->integer('quantity');
			$table->decimal('price');
			$table->string('strength');
			$table->text('dosage_form', 65535);
			$table->decimal('addon_price', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('drugs');
	}

}
