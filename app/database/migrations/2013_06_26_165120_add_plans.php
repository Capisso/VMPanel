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

            $table->string('name')->unique();
            $table->string('type'); // kvm, xen, ovz

            /* In bits/bytes */
            $table->integer('mem_initial');
            $table->integer('mem_burst');
            $table->integer('mem_swap');
            
            $table->integer('network_bandwidth');
            $table->integer('network_throughput');
            $table->integer('network_ipv4');
            $table->integer('network_ipv6');

            $table->integer('disk_size');
            $table->integer('disk_throughput');
            
            $table->integer('cpu_cores');
            $table->integer('cpu_priority');

            /* Flags */
            $table->boolean('active');
            $table->boolean('suspend_overbandwidth');
            $table->boolean('reinstallable');

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
		Schema::drop('plans');
	}

}