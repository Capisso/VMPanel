<?php

class UserTest extends TestCase {

    public function setUp() {
        parent::setUp();

        // Set up our users.
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testAdminUser()
    {
        $user = Sentry::getUserProvider()->findByLogin('admin@local.localhost');
        $this->be($user);

        $crawler = $this->client->request('GET', '/admin');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

}