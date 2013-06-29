<?php

class Region extends Eloquent {

    public function nodes() {
        return $this->hasMany('Node');
    }

}