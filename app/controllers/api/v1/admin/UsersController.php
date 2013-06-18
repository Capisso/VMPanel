<?php

namespace ApiVersionOne\Admin;

use Sentry;
use Response;

class UsersController extends BaseController {


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
        // @todo
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