<?php

namespace Admin;

use Input;
use Validator;
use Redirect;
use View;
use Config;

use API;

class NodeController extends BaseController {

    /**
     * Display a list of nodes
     *
     * @return Response
     */
    public function index() {
        $nodes = API::get('admin/nodes');

        return View::make('admin/node/index', array(
            'nodes' => $nodes['active'],
            'title' => 'Active Nodes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $nodes = API::get('admin/nodes');
        $allRegions = API::get('admin/regions');
        $pending = $nodes['pending'];

        $regions = array();
        foreach ($allRegions as $region) {
            $regions[$region->id] = $region->name;
        }

        return View::make('admin/node/create', array(
            'regions' => $regions,
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
        try {

            $node = API::post('admin/nodes', Input::all());
        } catch (Cartalyst\Api\Http\ApiHttpException $e) {

            if ($e->isServerError()) {

                App::abort($e->getStatusCode());
            } elseif ($e->isClientError()) {

                return Redirect::action('Admin\NodeController@create')
                    ->withErrors($e->getErrors())
                    ->with('message', $e->getMessage());
            }
        }

        return Redirect::action('Admin\NodeController@show', array($node->id));
    }

    /**
     * Display the user
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $node = API::get("admin/nodes/$id");

        return View::make('admin/node/show', array(
            'node' => $node,
            'title' => 'Manage Node: ' . $node->hostname
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
