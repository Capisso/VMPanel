<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        if($this->command->confirm('This will delete ALL of your data! Do you wish to coninue? [yes|no] ', false)) {

            $this->call('UserTableSeeder');

        }


	}

}