<?php

class IDSLog extends Eloquent {

    protected $table = 'ids_logs';

    protected $fillable = array('name', 'value', 'filters', 'impact', 'tags', 'page', 'ip', 'request');

}