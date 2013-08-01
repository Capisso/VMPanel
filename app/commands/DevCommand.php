<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class DevCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'capisso:dev';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generates the files you need to develop.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire() {
		// Load the default configuration and import it into the database
		$config = json_decode(file_get_contents(app_path(). '/../settings.json'));
		foreach($config as $key => $value) {
			Setting::set($key, $value);
		}
		$this->info('Generated configuration.');

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments() {
		return array(

		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions() {
		return array(

		);
	}
}
