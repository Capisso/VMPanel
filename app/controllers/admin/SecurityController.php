<?php

namespace Admin;

use View;
use IDSLog;

class SecurityController extends BaseController {

    public function getIndex() {

    }

    public function getIds() {
        $events = IDSLog::all();

        return View::make('admin.security.ids', compact('events'));
    }

}