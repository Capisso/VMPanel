<?php

use Illuminate\Database\Migrations\Migration;

class AddPlans extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plans', function($table) {
            $table->increments('id');

            $table->string('name');
            $table->string('type'); // kvm, xen, ovz

            /* In bits/bytes */
            $table->integer('memory');
            $table->integer('burst');
            $table->integer('swap');
            $table->integer('bandwidth');
            $table->integer('throughput');
            $table->integer('disk');
            $table->integer('cores');
            $table->integer('');

            /* Flags */
            $table->boolean('active');
            $table->boolean('suspend_on_bandwidth_overage');

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