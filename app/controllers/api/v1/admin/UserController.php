<?php

namespace ApiVersionOne\Admin;

use Sentry;
use Response;
use Input;
use Validator;
use DataGrid;
use Event;

class UserController extends BaseController {

    /**
     * Display a list of users
     *
     * @return \Cartalyst\Api\Http\Response
     */
    public function index() {
        if($permissions = $this->checkPermission('admin.user.index')) return $permissions;
        Event::fire('admin.user.index');

        $users = Sentry::getUserProvider()->findAll();

        return Response::api($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        if($permissions = $this->checkPermission('admin.user.store')) return $permissions;

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


            Event::fire('admin.user.store', array($user));

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
        if($permissions = $this->checkPermission('admin.user.show')) return $permissions;
        Event::fire('admin.user.show');

        $user = Sentry::getUserProvider()->findByLogin($username);
        if(!$user) {
            return Response::api('User not found.', 404);
        }

        return Response::api($user);
    }

    /**
     *
     * @param $username
     *
     * @return \Cartalyst\Sentry\Users\Cartalyst\Sentry\Users\UserInterface
     */
    public function update($username) {
        if($permissions = $this->checkPermission('admin.user.update')) return $permissions;

        $oldUser = Sentry::getUserProvider()->findByLogin($username);
        $newUser = Sentry::getUserProvider()->findByLogin($username);

        Event::fire('admin.user.show', array($oldUser, $newUser));

        return Response::api($newUser);
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
