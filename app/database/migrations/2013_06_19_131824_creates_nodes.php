<?php

use Illuminate\Database\Migrations\Migration;

class CreatesNodes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ip_addresses', function($table) {
            $table->increments('id');

            $table->string('address')->unique();
            $table->string('type');
            $table->boolean('active');

            $table->timestamps();
        });


        Schema::create('regions', function($table) {
            $table->increments('id');

            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('location');
            $table->boolean('active');

            $table->timestamps();
        });

        Schema::create('nodes', function ($table) {
            $table->increments('id');

            $table->string('hostname')->unique();
            $table->text('description');
            $table->integer('region_id')->unsigned();
            $table->boolean('active');

            $table->string('spec_virt');
            $table->string('spec_cpu');
            $table->string('spec_arch');
            $table->string('spec_distro');
            $table->string('spec_mem');
            $table->string('spec_throughput');
            $table->string('spec_mac');

            $table->timestamps();

            $table->foreign('region_id')->references('id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('ip_addresses');
        Schema::drop('regions');
        Schema::drop('nodes');
    }
}