<?php

class IDSLog extends Eloquent {

    protected $table = 'ids_log';

    protected $fillable = array('name', 'value', 'filters', 'impact', 'tags');

}