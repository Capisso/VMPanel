<?php

namespace ApiVersionOne\Admin;
use Input;
use Response;
use Sentry;
use API;
use App;

class BaseController extends \Controller {

    public $user;

    public function __construct() {
        if(Sentry::check()) {
            $this->user = Sentry::getUser();
        } else {
            $inputKey = Input::get('apikey');

            if(empty($inputKey)) {
                return Response::api('Invalid authorization token.', 401);
            }

            $key = APIKey::where('key', $inputKey);
            $this->user = $key->user()->get();
        }
    }

    public function checkPermission($permission) {
        if(!$this->user->hasPermission($permission)) {
            App::abort(401, 'You are not authorized.');
            return 'nope';
        }
    }

}