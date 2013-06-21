<?php

namespace ApiVersionOne\Admin;

use Response;
use Input;
use Validator;
use Region;

class RegionController extends BaseController {

    /**
     * Display a list of nodes
     *
     * @return Response
     */
    public function index() {
        $nodes = Region::all();

        return Response::api($nodes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $rules = array(
            'name' => 'required|alpha_num',
            'location' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return Response::api($validator, 400);
        }

        $region = new Region();

        $region->name = Input::get('name');
        $region->slug = Str::slug(Input::get('name'));
        $region->location = Input::get('location');
        $region->active = true;

        $region->save();

        return Response::api($region);
    }


    /**
     * Return the region
     *
     * @param $id
     *
     * @return \Cartalyst\Api\Http\Response
     */
    public function show($id) {
        $region = Region::find($id);

        return Response::api($region);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $username
     *
     * @return Response
     */
    public function edit($id) {
        $region = Region::find($id);

        return Response::api($region);
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
