<?php


class IPAddress extends Eloquent {

    protected $table = "ip_addresses";

    protected $fillable = array('address', 'type', 'active');

    public static function getInputType($address) {

        if(str_contains($address, '/')) {
            return 'cidr';
        } elseif(str_contains($address, '-')) {
            return 'range';
        } else {
            return 'single';
        }

    }


    public static function getType($address) {
        if(filter_var($address, FILTER_FLAG_IPV6)) {
            return 'ipv6';
        } else {
            return 'ipv4';
       }
    }

    /**
     * Determine if the IP address is valid.
     *
     * @param string $address
     *
     * @return bool
     */
    public static function valid($address) {
        return inet_pton($address) !== false;
    }

}
