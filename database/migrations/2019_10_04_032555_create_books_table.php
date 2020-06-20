<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('patient_id');
			$table->integer('doctor_id');
			$table->string('hour', 20)->nullable();
			$table->dateTime('start_book_time')->nullable();
			$table->dateTime('end_book_time')->nullable();
			$table->string('is_due', 10)->nullable()->default('false');
			$table->integer('refund')->nullable();
			$table->string('referal')->nullable();
			$table->string('home_service')->nullable();
			$table->text('complaints', 65535)->nullable();
			$table->text('examination', 65535)->nullable();
			$table->text('diagnosis', 65535)->nullable();
			$table->string('is_chat', 20)->nullable();
			$table->decimal('amount', 10)->nullable();
			$table->text('delivery_location', 65535)->nullable();
			$table->integer('status');
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
		Schema::drop('books');
	}

}
