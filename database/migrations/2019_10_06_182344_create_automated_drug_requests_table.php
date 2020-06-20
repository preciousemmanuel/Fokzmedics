<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAutomatedDrugRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('automated_drug_requests', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('patient_id');
			$table->integer('doctor_id');
			$table->text('prescriptions', 65535);
			$table->string('frequency');
			$table->text('dosage_form', 65535);
			$table->text('duration', 65535);
			$table->integer('quantity');
			$table->integer('status');
			$table->timestamps();
			$table->boolean('rejected')->default(0);
			$table->integer('book_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('automated_drug_requests');
	}

}
