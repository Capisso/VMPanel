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
            $pending = false;
        }

        return Response::api(array(
            'active' => $nodes,
            'pending' => $pending
        ));
    }

    /**
     * Either accept/reject a node.
     * If the node is accepted, add it to Salt and the databse
     * If the node is rejected, reject it from Salt 
     *
     * @return Response
     */
    public function store() {
        if($permissions = $this->checkPermission('admin.node.store')) return $permissions;

        $rules = array(
            'hostname' => 'required|unique:nodes',
            'region' => 'required|exists:regions,id',
            'action' => 'required'
        );


        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return Response::api($validator);
        }

        $action = Input::get('action');
        $hostname = Input::get('hostname');
        $region = Input::get('region');

        if($action == 'Accept') {

            $saltAccept = Salty::wheelModule('key')->accept($hostname);
            //checking

            $node = new Node();

            $node->hostname = $hostname;
            $node->description = '';
            $node->region_id = $region;
            $node->active = true;

            $node->save();

            return Response::api($node);

        } elseif($action == 'Reject') {

            $saltAccept = Salty::wheelModule('key')->reject($hostname);

        } else {
            return Response::api('Invalid action', 401);
        }

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

        $node = Node::find($id); 

        return Response::api($node);
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
