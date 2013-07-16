<?php

class HomeController extends BaseController {

    public function getIndex() {
        $user = Sentry::getUser();

        $userGroup = Sentry::getGroupProvider()->findByName('Users');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admins');

        if ($user->inGroup($userGroup)) {
            return Redirect::to('user');
        } elseif ($user->inGroup($adminGroup)) {
            return Redirect::to('admin');
        } else {
            throw new Exception('User is not in a recognizable group. This is most likely bad.');
        }
    }
}
