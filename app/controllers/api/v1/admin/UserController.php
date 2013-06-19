<?php

namespace ApiVersionOne\Admin;

use Sentry;
use Response;
use Input;
use Validator;

class UserController extends BaseController {


    /**
     * Display a list of users
     *
     * @return \Cartalyst\Api\Http\Response
     */
    public function index() {
        $users = Sentry::getUserProvider()->findAll();

        return Response::api($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $input = Input::all();

        $rules = array(
            'username'         => 'required|min:2|max:32|unique:users',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|min:6',
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Response::api($validator, 400);
        }

        try {

            $user = Sentry::register(
                array(
                    'username'   => mb_strtolower($input['username']),
                    'email'      => $input['email'],
                    'password'   => $input['password']
                )
            );
            $userGroup = Sentry::getGroupProvider()->findById(1);

            $user->isActivated(true);
            $user->addGroup($userGroup);

            return Response::api($user);

        } catch (Sentry\Users\UserExistsException $e) {
            return Response::api('User with this login already exists.', 409);
        }

    }


    /**
     * Display the specific user based on $username
     *
     * @param $username
     *
     * @return \Cartalyst\Api\Http\Response
     */
    public function show($username) {
        $user = Sentry::getUserProvider()->findByLogin($username);
        if(!$user) {
            return Response::api('User not found.', 404);
        }

        return Response::api($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id) {
        // @todo
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        // @todo
    }
}