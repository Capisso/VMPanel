<?php

class UserTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testAdminUser()
    {
        //$user = Sentry::getUserProvider()->findByLogin('admin@local.localhost');
        //$this->be($user);

        $response = $this->call('GET', 'admin/users');

        // Make sure we can't view the admin pages.
        $this->assertFalse($response->isNotFound());
    }

}