<?php

namespace ApiVersionOne\Admin;

use Capisso\Ip\IPv4\Address as IPv4Address;
use Sentry;
use Response;
use Input;
use Validator;
use CIDR;

class AddressController extends BaseController {

    /**
     * Display a list of nodes
     *
     * @permission admin.address.index
     *
     * @return Response
     */
    public function index() {
        if ($permissions = $this->checkPermission('admin.address.index')) {
            return $permissions;
        }

        var_dump(CIDR::cidrToRange('2605:f700:80:818::/64'));
        

        $addresses = array();
        $addresses['ipv4'] = IPAddress::where('type', 'ipv4')->get();
        $addresses['ipv6'] = IPAddress::where('type', 'ipv6')->get();

        return Response::api($addresses);
    }

    /**

     *
     * @return Response
     */

	/**
	 * Store a newly created resource in storage.
	 *
	 * @permission admin.address.store
	 *
	 * @return \Cartalyst\Api\Facades\Cartalyst\Api\Http\Response
	 * @throws \Exception
	 */
	public function store() {
        if ($permissions = $this->checkPermission('admin.address.store')) {
            return $permissions;
        }

        $rules = array(
            'addresses' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::api($validator, 400);
        }

        $addresses = explode("\r\n", Input::get('addresses'));

        $toAdd = array();
        foreach ($addresses as $address) {
			$address = new IPv4Address($address);

            switch ($type) {
                case 'single':
                    $toAdd[] = $address;

                    break;

                case 'cidr':
                    $range = CIDR::cidrToRange($address);
                    $allAddresses = CIDR::rangeToUsable($range[0], $range[1]);

                    $toAdd = array_merge($toAdd, $allAddresses);

                    break;

                case 'range':
                    $range = explode('-', $address);
                    $allAddresses = CIDR::rangeToUsable($range[0], $range[1]);

                    $toAdd = array_merge($toAdd, $allAddresses);

                    break;

                default:
                    throw new \Exception('Unexpected InputType');
                    break;
            }
        }

        foreach ($toAdd as $address) {
            IPAddress::create(array(
                'address' => $address,
                'type' => IPAddress::getType($address),
                'active' => true,
            ));
        }

        return Response::api($toAdd);
    }


    /**
     * Show info about a specific IP address
     *
     * @param $address
     *
     * @permission admin.address.show
     *
     * @return \Cartalyst\Api\Http\Response
     */
    public function show($address) {
        if ($permissions = $this->checkPermission('admin.address.show')) {
            return $permissions;
        }

        $address = IPAddress::where('address', $address)->first();

        return Response::api($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @permission admin.address.update
     *
     * @return Response
     */
    public function update($id) {
        if ($permissions = $this->checkPermission('admin.address.update')) {
            return $permissions;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @permission admin.address.delete
     *
     * @return Response
     */
    public function destroy($id) {
        if ($permissions = $this->checkPermission('admin.address.destroy')) {
            return $permissions;
        }
    }
}
