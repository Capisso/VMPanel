<?php

namespace ApiVersionOne\Admin;

use Sentry;
use Response;
use Input;
use Validator;

use Plan;

class PlanController extends BaseController {

    /**
     * Display a list of plans
     *
     * @return Response
     */
    public function index() {
        if($permissions = $this->checkPermission('admin.plan.index')) return $permissions;

        $plans = Plan::all();

        return Response::api($plans);
    }

    /**
     * Either accept/reject a node.
     * If the node is accepted, add it to Salt and the databse
     * If the node is rejected, reject it from Salt 
     *
     * @return Response
     */
    public function store() {
        if($permissions = $this->checkPermission('admin.plan.store')) return $permissions;


    }

    /**
     * Display the plan
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        if($permissions = $this->checkPermission('admin.plan.show')) return $permissions;

        $plan = Plan::find($id); 

        return Response::api($plan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id) {
        if($permissions = $this->checkPermission('admin.plan.update')) return $permissions;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        if($permissions = $this->checkPermission('admin.plan.destroy')) return $permissions;

    }
}
