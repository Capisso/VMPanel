<?php

class Node extends Eloquent {

    public function region() {
        return $this->hasOne('Region');
    }

    public function servers() {
        return $this->hasMany('Server');
    }

}