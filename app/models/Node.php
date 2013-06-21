<?php

class Node extends Eloquent {

    public function region() {
        return $this->hasOne('Region');
    }

}