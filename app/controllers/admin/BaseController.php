<?php

namespace Admin;

class BaseController extends \Controller {

    protected $layout = 'layouts/admin';

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = \View::make($this->layout);
        }
    }
}
