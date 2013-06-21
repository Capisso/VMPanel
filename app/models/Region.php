<?php

class Region extends Eloquent {

    public function region() {
        return $this->hasMany('Node');
    }

}