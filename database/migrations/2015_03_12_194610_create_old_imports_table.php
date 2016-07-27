<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOldImportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('old_imports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('merchant_no')->nullable();
			$table->string('batch_no')->nullable();
			$table->integer('transaction_date')->nullable();
			$table->integer('posting_date')->nullable();
			$table->string('type')->nullable();
			$table->string('card_no')->nullable();
			$table->string('status')->nullable();
			$table->string('trans_curr')->nullable();
			$table->float('trans_amount')->nullable();
			$table->string('acct_curr')->nullable();
			$table->float('acct_amount_gross')->nullable();
			$table->float('acct_total_charges')->nullable();
			$table->float('acct_amount_net')->nullable();
			$table->string('capture_method')->nullable();
			$table->string('internal_batch_no')->nullable();
			$table->string('merch_tran_ref')->nullable();
			$table->string('acquirer_ref')->nullable();
			$table->string('auth_code')->nullable();
			$table->string('merchant_name')->nullable();
			$table->string('transaction_country')->nullable();
			$table->string('acquirer_binica')->nullable();
			$table->string('area_of_event')->nullable();
			$table->string('fpi')->nullable();
			$table->string('expiry_date')->nullable();
			$table->string('internal_merchant_account')->nullable();
			$table->string('e_wallet_type')->nullable();
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
		Schema::drop('imports');
	}

}
