@extends('layouts.admin')

@section('content')

{{Form::model($user, array('class' => 'form-horizontal', 'action' => array('Admin\UserController@update', $user->id)))}}

{{Form::label('username')}}
{{Form::text('username')}}


{{Form::close()}}

@stop