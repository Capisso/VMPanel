<?php

namespace User;

class BaseController extends \Controller {

    protected $layout = 'layouts/user';

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
