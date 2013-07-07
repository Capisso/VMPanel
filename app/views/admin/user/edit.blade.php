@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/user/partials/sidebar')
@stop

@section('content')

{{ Form::model($user, array('class' => 'form-horizontal', 'action' => array('Admin\UserController@update', $user->id))) }}

    <div class="control-group">
        {{ Form::label('username','Username', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::text('username') }}
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('email','Email', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::email('email') }}
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('password','Password', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::password('password') }}
            <p class="help-block">If left blank password will not be updated.</p>
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('group','Group', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::select('group', $groups, $user->primaryGroup()->id) }}
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('activated','Activated', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::checkbox('activated') }}
            <p class="help-block">Notify email that user that their information has been updated.</p>
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('notify','Notify', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::checkbox('notify') }}
            <p class="help-block">Notify email that user that their information has been updated.</p>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-success">Create Account</button>
        </div>
    </div>
{{ Form::close() }}

@stop