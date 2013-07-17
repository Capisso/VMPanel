@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/user/partials/sidebar')
@stop

@section('content')

<div class="btn-group">
    {{ HTML::linkAction('Admin\UserController@index', 'Suspend', null, array('class' => 'btn btn-warning')) }}
    {{HTML::linkAction('Admin\UserController@edit', 'Edit', array($user->id), array('class' => 'btn btn-info'))}}
</div>

<div class="btn-group">
    {{HTML::linkAction('Admin\UserController@destroy', 'Delete', array($user->id), array('class' => 'btn btn-danger'))}}
</div>

<hr>
<dl class="dl-horizontal">
    <dt></dt>
    <dd></dd>
</dl>

<br>

<h4>Servers</h4>
Coming Soon


@stop
