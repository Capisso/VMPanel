<?php

namespace ApiVersionOne\Admin;

use Sentry;
use Response;
use Input;
use Validator;
use IPAddress;

class AddressController extends BaseController {

    /**
     * Display a list of nodes
     *
     * @permission admin.address.index
     *
     * @return Response
     */
    public function index() {
        $nodes = IPAddress::all();

        return Response::api($nodes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @permission admin.address.store
     *
     * @return Response
     */
    public function store() {
        $rules = array(
            'address' => 'required',
        );
    }


    /**
     * Show info about a specific IP address
     *
     * @param $address
     * @permission admin.address.show
     *
     * @return \Cartalyst\Api\Http\Response
     */
    public function show($address) {
        $address = IPAddress::where('address', $address)->first();

        return Response::api($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @permission admin.address.update
     *
     * @return Response
     */
    public function update($id) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @permission admin.address.delete
     *
     * @return Response
     */
    public function destroy($id) {

    }
}