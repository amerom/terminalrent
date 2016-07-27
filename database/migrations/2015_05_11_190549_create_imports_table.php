<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('imports', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('f_enr_vir_term_id')->nullable();
            $table->string('cde_bto_acct_nbr')->nullable();
            $table->string('nme_bto_acct_name')->nullable();
            $table->string('nme_bto_acct_adr')->nullable();
            $table->string('nme_bto_acct_cty')->nullable();
            $table->string('cde_bto_acct_postal_code')->nullable();
            $table->string('dsc_bto_acct_country')->nullable();
            $table->string('cde_tid_nbr')->nullable();
            $table->string('cde_sto_acct_nbr')->nullable();
            $table->string('nme_sto_acct_name')->nullable();
            $table->string('nme_sto_acct_adr')->nullable();
            $table->string('nme_sto_acct_cty')->nullable();
            $table->string('cde_sto_acct_postal_code')->nullable();
            $table->string('dsc_sto_acct_country')->nullable();
            $table->dateTime('transaction_date_time')->nullable();
            $table->float('f_enr_tra_tx_amt_eur')->nullable();
            $table->string('f_enr_avh_card_pan_id1')->nullable();
            $table->dateTime('transaction_date')->nullable();
            $table->integer('terminal_period')->unsigned()->nullable();
            $table->string('curr_currency_desc')->nullable();
            $table->string('terminal_id')->nullable();
            $table->string('site_number')->nullable();
            $table->string('onus_brand_name')->nullable();
            $table->string('onus_trx_date_trunc')->nullable();
            $table->string('cde_party_nb')->nullable();
            $table->string('nme_party_name')->nullable();
            $table->string('term_bank_account')->nullable();
            $table->string('f_enr_tra_free_ref')->nullable();
            $table->string('f_enr_tra_tx_cancel_amt_eur')->nullable();
            $table->string('f_enr_tra_tx_cancel_flag')->nullable();
            $table->string('cde_tid_status')->nullable();
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
		//
	}

}
