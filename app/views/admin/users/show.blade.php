@extends('layouts.admin')

@section('content')

{{Form::model($user, array('action' => array('Admin\UserController@update', $user->id)))}}

@stop