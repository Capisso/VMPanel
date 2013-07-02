<?php

class Plan extends Eloquent {
    
    public function servers() {
        return $this->hasMany('Server');
    }

}