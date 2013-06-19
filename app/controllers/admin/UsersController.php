<?php

namespace Admin;

use View;
use Sentry;
use API;
use Redirect;
use App;

class UsersController extends BaseController {

    /**
     * Display a list of users
     *
     * @return Response
     */
    public function index() {
        $users = API::get('admin/users');

        return View::make('admin/users/index', array('users' => $users, 'title' => 'All Users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('admin/users/create', array('title' => 'Create User'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {


        try {

            $user = API::post('admin/users', \Input::all());

            return Redirect::to('admin/users/'. $user->id);

        } catch (Cartalyst\Api\Http\ApiHttpException $e) {

            if ($e->isServerError()) {

                App::abort($e->getStatusCode());

            } elseif ($e->isClientError()) {

                return Redirect::to('admin/users/create')
                    ->withErrors($e->getErrors())
                    ->with('message', $e->getMessage());
            }

        }

    }

    /**
     * Display the user
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        try {
            $sentryUser = Sentry::getUserProvider()->findById($id);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return 'User not found';
        }

        $user = API::get('admin/users/'. $sentryUser->username);

        return View::make('admin/users/show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $username
     *
     * @return Response
     */
    public function edit($id) {
        try {
            $sentryUser = Sentry::getUserProvider()->findById($id);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return 'User not found';
        }

        $user = API::get('admin/users/'. $sentryUser->username);


        return View::make('admin/users/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id) {
        // @todo: API::post()
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        // @todo: API::post()
    }
}