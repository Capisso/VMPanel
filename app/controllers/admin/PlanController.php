<?php

namespace Admin;

use Input;
use Validator;
use Redirect;
use View;
use Setting;
use API;

class PlanController extends BaseController {

    /**
     * Display a list of plans including servers on that plan
     *
     * @return Response
     */
    public function index() {
        $plans = API::get('admin/plans');

        return View::make('admin/plan/index', array(
            'plans' => $plans,
            'title' => 'Plans'
        ));
    }

    /**
     * Show the form for creating a new plan.
     *
     * @return Response
     */
    public function create() {
        return View::make('admin/plans/create', array(
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

            $node = API::post('admin/plans', Input::all());

        } catch (Cartalyst\Api\Http\ApiHttpException $e) {

            if ($e->isServerError()) {

                App::abort($e->getStatusCode());

            } elseif ($e->isClientError()) {

                return Redirect::action('Admin\PlanController@create')
                    ->withErrors($e->getErrors())
                    ->with('message', $e->getMessage());
            }
        }

        return Redirect::action('Admin\PlanController@show', array($plan->id));
    }

    /**
     * Display the play
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $plan = API::get("admin/plans/$id");

        return View::make('admin/plans/show', array(
            'plan' => $plan,
            'title' => 'Manage Plan: '.$plan->name 
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
