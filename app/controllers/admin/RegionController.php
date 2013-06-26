<?php

namespace Admin;

use View;
use Region;
use Validator;
use Input;
use Redirect;
use Str;

class RegionController extends BaseController {

    /**
     * Display a list of nodes
     *
     * @return Response
     */
    public function index() {
        $nodes = Region::all();

        return View::make('admin/region/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('admin/region/create');
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
            return Redirect::action('Admin\RegionController@create')->withErrors($validator);
        }

        $region = new Region();

        $region->name = Input::get('name');
        $region->slug = Str::slug(Input::get('name'));
        $region->location = Input::get('location');
        $region->active = true;

        $region->save();

        Event::fire('admin.region.create', array($region));

        return Redirect::action('Admin\RegionController@show', array($region->id));

    }

    /**
     * Display the user
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $region = Region::find($id);

        return View::make('admin/region/show', compact('region'));
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

        return View::make('admin/region/edit', compact('region'));
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
