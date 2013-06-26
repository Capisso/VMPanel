<?php

namespace Admin;

use View;
use Node;
use Config;
use Salty;

class NodeController extends BaseController {

    /**
     * Display a list of nodes
     *
     * @return Response
     */
    public function index() {
        $nodes = Node::all();

        return View::make('admin/node/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        Config::set('salt.credentials', array('clone1018' => 'capisso'));
        Config::set('salt.auth_type', 'pam');

        $pending = Salty::wheelModule('key')->listPending();

        dd($pending);

        return View::make('admin/node/create', array(
            'title' => 'Create a Node'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {



    }

    /**
     * Display the user
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $username
     *
     * @return Response
     */
    public function edit($id) {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id) {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
    }
}
