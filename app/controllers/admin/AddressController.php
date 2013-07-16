<?php

namespace Admin;

use View;
use IPAddress;
use Validator;
use Input;
use Redirect;
use Str;
use App;
use API;

class AddressController extends BaseController {

    /**
     * Display a list of nodes
     *
     * @return Response
     */
    public function index() {
        $addresses = API::get('admin/addresses');

        return View::make('admin/address/index', array(
            'addresses' => $addresses,
            'title' => 'IP Addresses',
            'description' => 'A list of IP Addresses tracked by the panel.'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('admin/address/create', array(
            'title' => 'Add IP Addresses',
            'description' => 'You can create either a single IP Address or a block of IP addresses using the tool below.'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        try {

            API::post('admin/addresses', Input::all());

        } catch (Cartalyst\Api\Http\ApiHttpException $e) {

            dd($e->getErrors());
            if ($e->isServerError()) {

                App::abort($e->getStatusCode());

            } elseif ($e->isClientError()) {

                return Redirect::action('Admin\AddressController@create')
                    ->withErrors($e->getErrors())
                    ->with('message', $e->getMessage());
            }
        }

        return Redirect::action('Admin\AddressController@index');
    }

    /**
     * Display the user
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $region = IPAddress::find($id);

        return View::make('admin/address/show', compact('region'));
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
