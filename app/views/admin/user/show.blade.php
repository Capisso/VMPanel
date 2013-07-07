@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/user/partials/sidebar')
@stop

@section('content')

<div class="btn-group">
    {{Form::open(array('method' => 'delete', 'class' => 'pull-right', 'action' => array('Admin\UserController@destroy', $user->id)))}}
    {{HTML::linkAction('Admin\UserController@edit', 'Edit', array($user->id), array('class' => 'btn
    btn-default'))}}
    <input type="submit" class="btn btn-danger" value="Delete"/>
    {{Form::close()}}

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