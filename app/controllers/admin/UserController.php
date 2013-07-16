<?php

namespace Admin;

use View;
use Sentry;
use API;
use Redirect;
use App;

class UserController extends BaseController {
    
    /**
     * Display a list of users
     *
     * @return Response
     */
    public function index() {
        $users = API::get('admin/users');

        return View::make('admin/user/index', array(
            'users' => $users,
            'title' => 'Users',
            'description' => 'Below is a full list of all users VMPanel is keeping track of. If this list is out of sync with your billing system, please sync or create the user using the nav on the right.'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $sentryGroups = Sentry::getGroupProvider()->findAll();
        $groups = array();
        foreach($sentryGroups as $group) {
            $groups[$group->id] = $group->name;
        }

        return View::make('admin/user/create', array(
            'groups' => $groups,
            'title' => 'Create User',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        try {

            $user = API::post('admin/users', \Input::all());

            return Redirect::action('Admin\UserController@show', array($user->id));

        } catch (Cartalyst\Api\Http\ApiHttpException $e) {

            if ($e->isServerError()) {

                App::abort($e->getStatusCode());
            } elseif ($e->isClientError()) {

                return Redirect::action('Admin\UserController@create')
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
            return Redirect::action('Admin\UsersController@index');
        }

        $user = API::get('admin/users/'. $sentryUser->username);

        return View::make('admin/user/show', array(
            'user' => $user,
            'title' => 'User: ' .$user->username
        ));
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
            return Redirect::action('Admin\UsersController@index');
        }

        $user = API::get('admin/users/'. $sentryUser->username);
        $activeGroups = $user->getGroups();

        $sentryGroups = Sentry::getGroupProvider()->findAll();
        $groups = array();

        $aGroups = $groups = array();
        foreach($activeGroups as $group) {
            $aGroups[] = $group->id;
        }

        foreach($sentryGroups as $group) {
            $groups[$group->id] = $group->name;
        }


        return View::make('admin/user/edit', array(
            'aGroups' => $aGroups,
            'groups' => $groups,
            'user' => $user,
            'title' => "Edit User: ".$user->username
        ));
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