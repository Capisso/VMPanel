<?php

namespace Admin\Security;

use Admin\BaseController;
use View;
use IDSLog;

class HomeController extends BaseController {

    public function getIndex() {

        return View::make('admin/security/index');
    }

    public function getIds() {
        $events = IDSLog::all();

        return View::make('admin/security/ids', compact('events'));
    }

}