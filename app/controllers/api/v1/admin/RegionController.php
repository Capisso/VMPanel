<?php

namespace ApiVersionOne\Admin;

use Response;
use Input;
use Validator;
use Region;
use Str;

class RegionController extends BaseController {

    /**
     * Lists all regions that exist in the database.
     *
     * @permission admin.region.index
     *
     * @return \Cartalyst\Api\Http\Response
     */
    public function index() {
        $nodes = Region::all();

        return Response::api($nodes);
    }

    /**
     * Create a new region
     *
     * @permission admin.region.store
     *
     * @return \Cartalyst\Api\Http\Response
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

        Event::fire('admin.region.create', array($region));

        return Response::api($region);
    }

    /**
     * Show info about an existing region
     *
     * @param $id
     * @permission admin.region.show
     *
     * @return \Cartalyst\Api\Http\Response
     */
    public function show($id) {
        $region = Region::find($id);

        return Response::api($region);
    }

    public function update($id) {

    }

    public function destroy($id) {

    }
}
