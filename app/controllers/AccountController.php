<?php


class AccountController extends BaseController
{

    public function __construct()
    {
        $this->beforeFilter('guest', ['only' => ['getLogin', 'postLogin']]);
    }

    public function getLogin()
    {
        return View::make('account/login');
    }

    public function postLogin()
    {
        $input = Input::all();

        $rules = array(
            'username'    => 'required',
            'password' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::to('account/login')->withErrors($validator);
        }

        try {
            // Set login credentials
            $credentials = array(
                'username'    => $input['username'],
                'password' => $input['password'],
            );

            // Try to authenticate the user
            $user = Sentry::authenticate($credentials, Input::get('remember', false));
            Event::fire('user.login', array($user));

            $adminGroup = Sentry::getGroupProvider()->findByName('Admins');

            if($user->inGroup($adminGroup)) {
                return Redirect::to('admin');
            } else {
                return Redirect::to('user');
            }

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            dd($e);
            return Redirect::to('account/login')->withErrors(['Login field is required.']);
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            return Redirect::to('account/login')->withErrors(['Password field is required.']);
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::to('account/login')->withErrors(['User was not found.']);
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            return Redirect::to('account/login')->withErrors(['User is not activated.']);
        }

            // The following is only required if throttle is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            return Redirect::to('account/login')->withErrors(['User is suspended.']);
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            return Redirect::to('account/login')->withErrors(['User is banned.']);
        }
    }

    public function getForgot()
    {
        return View::make('account/forgot');
    }

    public function postForgot()
    {
        $input = Input::all();

        $rules = array(
            'email' => 'required|email'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::to('account/forgot')->withErrors($validator);
        }


        try {
            // Find the user using the user email address
            $user = Sentry::getUserProvider()->findByLogin($input['email']);

            $forgotCode = $user->getResetPasswordCode();
            Event::fire('user.forgot', array($user, $forgotCode));

            return Redirect::to('account/resetting');
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::to('account/forgot')->withErrors(['User was not found.']);
        }
    }

    public function getResetting()
    {
        return View::make('account/resetting');
    }

    public function getReset($email, $code)
    {
        return View::make('account/reset', array('email' => $email, 'code' => $code));
    }

    public function postReset()
    {
        $input = Input::all();

        $rules = array(
            'email'            => 'required|email',
            'password'         => 'required|min:6',
            'password_confirm' => 'required|same:password',
            'code'             => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::to(URL::to('account/reset', array($input['email'], $input['code'])))->withErrors(
                $validator
            );
        }

        try {
            // Find the user using the user id
            $user = Sentry::getUserProvider()->findByLogin($input['email']);

            // Check if the reset password code is valid
            if ($user->checkResetPasswordCode($input['code'])) {
                // Attempt to reset the user password
                if ($user->attemptResetPassword($input['code'], $input['password'])) {
                    return Redirect::to('account/login');
                } else {
                    return Redirect::to('account/forgot');
                }
            } else {
                return Redirect::to(URL::to('account/reset', array($input['email'], $input['code'])))->withErrors(['Invalid reset key.']);
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::to(URL::to('account/reset', array($input['email'], $input['code'])))->withErrors(['User was not found.']);
        }
    }

    public function getLogout()
    {
        Sentry::logout();

        return Redirect::to('');
    }

}
