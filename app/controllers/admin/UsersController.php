<?php

namespace Admin;

use View;
use Sentry;

class UsersController extends BaseController
{
    protected $layout = 'layouts/admin';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = Sentry::getUserProvider()->findAll();

        return View::make('admin/users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin\userscreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $user = Sentry::getUserProvider()->findById($id);

        return View::make('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = Sentry::getUserProvider()->findById($id);

        return View::make('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}