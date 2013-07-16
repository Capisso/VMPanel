<?php

namespace ApiVersionOne\Admin;

use Input;
use Response;
use Sentry;
use API;
use App;

class BaseController extends \Controller {

    protected $user;

    public function __construct() {
        if (Sentry::check()) {
            $this->user = Sentry::getUser();
        } else {
            $inputKey = Input::get('apikey');

            if (empty($inputKey)) {
                return Response::api('Invalid authorization token.', 401);
            }

            $key = APIKey::where('key', $inputKey);
            $this->user = $key->user()->get();
        }
    }

    public function checkPermission($permission) {

        if (!$this->user->hasPermission($permission)) {
            return Response::api('You don\'t have permission to access this.', 401);
        }
    }
}
