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
     * Add a plan
     *
     * @return Response
     */
    public function store() {
        if($permissions = $this->checkPermission('admin.plan.store')) return $permissions;

        $input = Input::all();

        $rules = array(
            'name' => 'required|min:2|max:255',
            'type' => 'required',

            'mem_initial' => 'required|numeric',
            'mem_burst' => 'required|numeric',
            'mem_swap' => 'required|numeric',

            'network_bandwidth' => 'required|numeric',
            'network_throughput' => 'required|numeric',
            'network_ipv4' => 'required|numeric',
            'network_ipv6' => 'required|numeric',

            'disk_size' => 'required|numeric',
            'disk_throughput' => 'required|numeric',

            'cpu_cores' => 'required|numeric',
            'cpu_priority' => 'required|numeric',

            'active' => 'required',
            'suspend_overbandwidth' => 'required',
            'reinstallable' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return Response::api($validator);
        }


        $plan = new Plan();

        $plan->name = $input['name'];


        $plan->save();
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
