<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('fullname', 100);
			$table->string('email', 150)->unique();
			$table->string('phone', 15)->nullable();
			$table->string('password', 100)->nullable();
			$table->string('fbid', 100)->nullable();
			$table->string('address', 300)->nullable();
			$table->string('city', 80)->nullable();
			$table->string('country', 80)->nullable();
			$table->string('image')->nullable();
			$table->date('date_birth')->nullable();
			$table->string('merchant_id', 50)->nullable();
			
			$table->string('referal')->nullable();
			$table->string('state')->nullable();
			$table->date('referal_end')->nullable();
			$table->string('accnt_name')->nullable();
			$table->string('accnt_num', 10)->nullable();
			$table->string('accnt_bank')->nullable();
			$table->string('gender', 10)->nullable();
			$table->boolean('updated')->default(0);
			$table->integer('specialization_id')->nullable();
			$table->enum('consult_type', array('home','hospital','online',''))->nullable();
			$table->string('consult_hour')->nullable();
			$table->text('description', 65535)->nullable();
			$table->text('education', 65535)->nullable();
			$table->boolean('approved')->nullable()->default(0);
			$table->text('licence', 65535)->nullable();
			$table->text('hospital_address', 65535)->nullable();
			$table->string('business_name')->nullable();
			$table->string('supretendent_name')->nullable();
			$table->string('supretendent_phone')->nullable();
			$table->string('licence_number')->nullable();
			$table->integer('category_id')->nullable();
			$table->enum('type', array('1','2','3','4'))->nullable();
			$table->timestamps();
			$table->timestamp('email_verified_at')->nullable();
			$table->rememberToken();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
