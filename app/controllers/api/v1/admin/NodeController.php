<?php

namespace ApiVersionOne\Admin;

use Sentry;
use Response;
use Input;
use Validator;
use Node;
use Salty;
use Config;

class NodeController extends BaseController {

    /**
     * Display a list of nodes
     *
     * @return Response
     */
    public function index() {
        if($permissions = $this->checkPermission('admin.node.index')) return $permissions;

        $nodes = Node::all();

        // Make sure we catch a potentially broken salt config
        try {
            $pending = Salty::wheelModule('key')->listPending();
        } catch (\ErrorException $e) {
            $pending = array();
        }

        return Response::api(array(
            'active' => $nodes,
            'pending' => $pending
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        if($permissions = $this->checkPermission('admin.node.store')) return $permissions;

        $rules = array(
            'hostname' => 'required|unique:nodes'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return Response::api($validator);
        }

        $info = Salty::against(Input::get('hostname'))->module('status')->cpuinfo()->getResults(true);
        dd($info);
    }

    /**
     * Display the node
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        if($permissions = $this->checkPermission('admin.node.show')) return $permissions;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id) {
        if($permissions = $this->checkPermission('admin.node.update')) return $permissions;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        if($permissions = $this->checkPermission('admin.node.destroy')) return $permissions;

    }
}
