<?php

class Node extends Eloquent {

    public function region() {
        return $this->belongsTo('Region');
    }

    public function servers() {
        return $this->hasMany('Server');
    }

}