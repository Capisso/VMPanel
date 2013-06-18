<?php

use Illuminate\Database\Migrations\Migration;

class CreateIdsLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ids_log', function($table) {
            $table->increments('id');

            $table->string('name');
            $table->string('value');
            $table->text('filters');
            $table->integer('impact');
            $table->text('tags');

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
		Schema::drop('ids_log');
	}

}