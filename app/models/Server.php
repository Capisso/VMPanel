<?php

class Server extends Eloquent {
    
    public function plan() {
        return $this->belongsTo('Plan');
    }

}