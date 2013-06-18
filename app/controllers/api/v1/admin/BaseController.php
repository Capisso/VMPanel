<?php

namespace ApiVersionOne\Admin;
use Input;
use Response;
use Sentry;

class BaseController extends \Controller {

    public function __construct() {
        $requestKey = Input::get('apikey');

        if(empty($requestKey)) {
            return Response::api('Invalid authorization token.', 401);
        }


    }

}