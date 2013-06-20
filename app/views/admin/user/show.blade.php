@extends('layouts/admin')

@section('content')

<h2>Manage User: {{{$user->username}}}</h2>


<br>
<div class="row">
    <div class="col col-lg-3">
        @include('admin/user/partials/sidebar')
    </div>

    <div class="col col-lg-9">
        <h2>{{{$user->username}}}</h2>

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
    </div>
</div>


@stop