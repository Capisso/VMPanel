<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User {

    /**
     * Return the primary group of a user.
     *
     * @return Cartalyst\Sentry\Groups\Eloquent\Group
     */
    public function primaryGroup() {

        $groups = $this->getGroups();

        return $groups[0];

    }

	public function keys() {
		return $this->hasMany('SSHKey');
	}

}
