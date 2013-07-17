<?php


class IPAddress extends Eloquent {

    protected $table = "ip_addresses";

    protected $fillable = array('address', 'type', 'active');
    protected $hidden = array('id');

    /**
     * Get the type of input we're trying to parse
     *
     * @param string $address
     *
     * @return string
     */
    public static function getInputType($address) {

        if(str_contains($address, '/')) {
            return 'cidr';
        } elseif(str_contains($address, '-')) {
            return 'range';
        } else {
            return 'single';
        }

    }

    /**
     * Return type of IP Address (be it IPv4 or IPv6)
     *
     * @param string $address
     *
     * @return string
     */
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
