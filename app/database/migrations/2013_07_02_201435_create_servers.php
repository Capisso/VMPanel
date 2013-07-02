<?php

use Illuminate\Database\Migrations\Migration;

class CreateServers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servers', function($table) {
            $table->increments('id');

            $table->string('hostname')->index();
            $table->string('type'); // kvm, xen, ovz

            $table->integer('plan_id')->unsigned()->nullable();
            $table->integer('ip_id')->unsigned(); // primary ip
            $table->integer('user_id')->unsigned();

            // Items are null until overwritten
            $table->integer('mem_initial')->nullable()->default(null);
            $table->integer('mem_burst')->nullable()->default(null);
            $table->integer('mem_swap')->nullable()->default(null);

            $table->integer('network_bandwidth')->nullable()->default(null);
            $table->integer('network_throughput')->nullable()->default(null);
            $table->integer('network_ipv4')->nullable()->default(null);
            $table->integer('network_ipv6')->nullable()->default(null);

            $table->integer('disk_size')->nullable()->default(null);
            $table->integer('disk_throughput')->nullable()->default(null);

            $table->integer('cpu_cores')->nullable()->default(null);
            $table->integer('cpu_priority')->nullable()->default(null);

            /* Flags */
            $table->boolean('active');
            $table->boolean('suspend_overbandwidth')->nullable()->default(null);
            $table->boolean('reinstallable')->nullable()->default(null);

            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('plans');
            $table->foreign('ip_id')->references('id')->on('ip_addresses');
            $table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('servers');
	}

}