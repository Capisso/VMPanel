<?php

use Illuminate\Database\Migrations\Migration;

class AddGroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Sentry::getGroupProvider()->create(array(
                'name'        => 'Users'
            ));
        Sentry::getGroupProvider()->create(array(
                'name'        => 'Resellers'
            ));
        Sentry::getGroupProvider()->create(array(
                'name'        => 'Admins'
            ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$groups = array('Users', 'Resellers', 'Admins');

        foreach($groups as $group) {
            $sentryGroup = Sentry::getGroupProvider()->findByName($group);

            $sentryGroup->delete();
        }
	}

}