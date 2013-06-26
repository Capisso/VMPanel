<?php

namespace Admin;

use Input;
use Validator;
use Redirect;
use View;
use Config;

use Node;
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
        Config::set('salt.credentials', array('username' => 'clone1018', 'password' => 'capisso'));
        Config::set('salt.auth_type', 'pam');
        Config::set('salt.api_certificate_path', false);

        try {
            $pending = Salty::wheelModule('key')->listPending();
        } catch (\Requests_Exception $e) {
            $pending = false;
        }

        return View::make('admin/node/create', array(
            'pending' => $pending,
            'title' => 'Create a Node'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        // Verify we can add this
        $rules = array(
            'hostname' => 'required|unique:nodes'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return Redirect::action('Admin\NodeController@create')->withErrors($validator);
        }

        $info = Salty::against(Input::get('hostname'))->module('status')->cpuinfo()->getResults(true);
        dd($info);

    }

    /**
     * Display the user
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $node = Node::find($id);

        return View::make('admin/node/show', array(
            'node' => $node,
            'title' => 'Manage Node: '.$node->hostname
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
