<?php

use Illuminate\Database\Migrations\Migration;

class AddingPlanPermissions extends Migration {

    protected $permissions = array(
        'Admins' => array(
            'admin.plan.index' => 1,
            'admin.plan.store' => 1,
            'admin.plan.show' => 1,
            'admin.plan.update' => 1,
            'admin.plan.delete' => 1,
        )
    );

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admins = Sentry::getGroupProvider()->findByName('Admins');
        $admins->permissions = $this->permissions['Admins'];
        $admins->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $admins = Sentry::getGroupProvider()->findByName('Admins');
        $diff = array_diff($this->permissions, $admins->permissions);

        $admins->permissions = $diff;
        $admins->save();
    }

}