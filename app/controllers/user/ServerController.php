<?php

namespace User;

use View;

class ServerController extends BaseController {

    public function index() {
        return View::make('user/server/index');
    }

}