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

        $crawler = $this->client->request('GET', '/admin');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

}