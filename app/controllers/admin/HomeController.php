<?php

namespace Admin;

use View;
use API;

class HomeController extends BaseController {

    public function getIndex(){
        $nodes = API::get('admin/nodes');
        $nodes = $nodes['active'];

        return View::make('admin.index', array(
            'nodes' => $nodes,
            'title' => 'Admin Homepage'
        ));
    }

}