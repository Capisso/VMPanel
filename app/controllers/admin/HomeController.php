<?php

namespace Admin;

class HomeController extends BaseController {

    public function showIndex(){
        return View::make('admin.index');
    }

}