<?php

use Illuminate\Database\Migrations\Migration;

class MigrationCartalystCompositeConfigInstall extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('config', function($table)
		{
			$table->string('environment');
			$table->string('group');
			$table->string('namespace')->nullable();
			$table->string('item');
			$table->text('value')->nullable();

			// We'll need to ensure that MySQL uses the InnoDB engine to
			// support the indexes, other engines aren't affected.
			$table->engine = 'InnoDB';
			$table->unique(array('environment', 'group', 'namespace', 'item'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('config');
	}

}
