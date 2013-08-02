<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSshKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('ssh_keys', function (Blueprint $table) {
			$table->increments('id');

			$table->string('name');
			$table->text('key');
			$table->integer('user_id')->unsigned();

			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('ssh_keys');
	}
}
