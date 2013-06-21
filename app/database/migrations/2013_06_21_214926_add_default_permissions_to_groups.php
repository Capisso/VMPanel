<?php

use Illuminate\Database\Migrations\Migration;

class AddDefaultPermissionsToGroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $permissions = array(
            'Admins' => array(
                'admin.server.index' => 1,
                'admin.server.create' => 1,
                'admin.server.show ' => 1,
                'admin.server.update ' => 1,
                'admin.server.power.start' => 1,
                'admin.server.power.reboot' => 1,
                'admin.server.power.stop' => 1,
                'admin.server.delete' => 1,

                'admin.address.index' => 1,
                'admin.address.store' => 1,
                'admin.address.show' => 1,
                'admin.address.update' => 1,
                'admin.address.delete' => 1,

                'admin.node.index' => 1,
                'admin.node.store' => 1,
                'admin.node.show' => 1,
                'admin.node.update' => 1,
                'admin.node.delete' => 1,

                'admin.region.index' => 1,
                'admin.region.store' => 1,
                'admin.region.show' => 1,
                'admin.region.update' => 1,
                'admin.region.delete' => 1,

                'admin.user.index' => 1,
                'admin.user.store' => 1,
                'admin.user.show' => 1,
                'admin.user.update' => 1,
                'admin.user.delete' => 1,
            ),

            'Users' => array(
                'user.server.index' => 1,
                'user.server.show ' => 1,
                'user.server.update' => 1,
                'user.server.power.start' => 1,
                'user.server.power.reboot' => 1,
                'user.server.power.stop' => 1,

                'user.snapshot.index' => 1,
                'user.snapshot.show' => 1,
                'user.snapshot.create' => 1,
                'user.snapshot.delete' => 1,
            )
        );

		$admins = Sentry::getGroupProvider()->findByName('Admins');
        $admins->permissions = $permissions['Admins'];
        $admins->save();

        $users = Sentry::getGroupProvider()->findByName('Users');
        $users->permissions = $permissions['Users'];
        $users->save();

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        $admins = Sentry::getGroupProvider()->findByName('Admins');
        $admins->permissions = array();
        $admins->save();

        $users = Sentry::getGroupProvider()->findByName('Users');
        $users->permissions = array();
        $users->save();
	}

}