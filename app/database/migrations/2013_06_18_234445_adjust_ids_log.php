<?php

use Illuminate\Database\Migrations\Migration;

class AdjustIdsLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ids_logs', function($table) {
            $table->string('page')->after('name');
            $table->string('ip')->after('tags');
            $table->text('request')->after('tags');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ids_logs', function($table) {
            $table->dropColumn('page');
            $table->dropColumn('ip');
            $table->dropColumn('request');
        });
	}

}