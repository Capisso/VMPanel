<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $users = Sentry::getUserProvider()->findAll();
        foreach($users as $user) {
            $user->delete();
        }

        // Add some random users
        for($i = 0; $i < 100; $i++) {
            $unique = Str::random(10);
            $user = Sentry::getUserProvider()->create(array(
                    'username' => $unique,
                    'email' => $unique . '@local.localhost',
                    'password' => $unique
                ));

            $activationCode = $user->getActivationCode();
            $user->attemptActivation($activationCode);

            $userGroup = Sentry::getGroupProvider()->findByName('Users');

            $user->addGroup($userGroup);
        }


        // Add an admin user
        $user = Sentry::getUserProvider()->create(array(
                'username' => 'admin',
                'email' => 'admin@local.localhost',
                'password' => 'admin'
            ));

        $activationCode = $user->getActivationCode();
        $user->attemptActivation($activationCode);

        $userGroup = Sentry::getGroupProvider()->findByName('Admins');

        $user->addGroup($userGroup);
    }

}