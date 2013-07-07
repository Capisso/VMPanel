@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/user/partials/sidebar')
@stop

@section('content')

<div class="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p>Please note if you store your customers on an external billing panel you'll need to add and sync the user there too.</p>
</div>

{{ Form::open(array('action' => 'Admin\UserController@store', 'class' => 'form-horizontal')) }}

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
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('group','Group', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::select('group', $groups) }}
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('notify','Notify', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::checkbox('notify') }}
            <p class="help-block">Notify email that user has been created on their behalf.</p>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-success">Create Account</button>
        </div>
    </div>
{{ Form::close() }}

@stop