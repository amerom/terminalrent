<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTerminalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('user_terminals', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('terminal_id');
            $table->integer('user_id')->unsigned();
            $table->dateTime('from');
            $table->dateTime('to');
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
