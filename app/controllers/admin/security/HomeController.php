<?php

namespace Admin\Security;

use Admin\BaseController;
use View;
use IDSLog;

class HomeController extends BaseController {

    public function getIndex() {

        return View::make('admin/security/index', array(
            'title' => 'Security Homepage',
            'description' => 'We\'ll be adding more information here soon, for now view the individual modules on the left.',
        ));
    }

}