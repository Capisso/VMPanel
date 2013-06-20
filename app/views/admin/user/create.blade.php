@extends('layouts/admin')

@section('content')

<h2>Create New User</h2>
<p>Please note if you store your customers on an external billing panel you'll need to add and sync the user there too.</p>

<br>
<div class="row">
    <div class="col col-lg-3">
        @include('admin/user/partials/sidebar')
    </div>

    <div class="col col-lg-6">

        {{Form::open(array('action' => 'Admin\UserController@store', 'class' => 'form-horizontal'))}}
        <div class="row">
            {{Form::label('username','Username', array('class' => 'col col-lg-2 control-label'))}}
            <div class="col col-lg-10">
                {{Form::text('username')}}
            </div>
        </div>
        <div class="row">
            {{Form::label('email','Email', array('class' => 'col col-lg-2 control-label'))}}
            <div class="col col-lg-10">
                {{Form::email('email')}}
            </div>
        </div>
        <div class="row">
            {{Form::label('password','Password', array('class' => 'col col-lg-2 control-label'))}}
            <div class="col col-lg-10">
                {{Form::password('password')}}
            </div>
        </div>
        <div class="row">
            {{Form::label('group', 'Group', array('class' => 'col col-lg-2 control-label'))}}
            <div class="col col-lg-10">
                {{Form::select('group', $groups)}}
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-10 col-offset-2">
                <button type="submit" class="btn btn-success">Create Account</button>
            </div>
        </div>
        {{Form::close()}}

    </div>
</div>


@stop