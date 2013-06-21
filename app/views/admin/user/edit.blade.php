@extends('layouts/admin')

@section('content')

<h2>Edit User: {{{$user->username}}}</h2>


<br>
<div class="row">
    <div class="col col-lg-3">
        @include('admin/user/partials/sidebar')
    </div>

    <div class="col col-lg-6">

        {{Form::model($user, array('class' => 'form-horizontal', 'action' => array('Admin\UserController@update', $user->id)))}}
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
                <p>If left blank password will not be updated.</p>
            </div>
        </div>
        <div class="row">
            {{Form::label('group', 'Group', array('class' => 'col col-lg-2 control-label'))}}
            <div class="col col-lg-10">

                <select name="" id="" multiple>
                    @foreach($groups as $id => $name)


                    @if(in_array($id, $aGroups))
                    <option value="{{$id}}" selected>{{{$name}}}</option>
                    @else
                    <option value="{{$id}}">{{{$name}}}</option>
                    @endif

                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            {{Form::label('activated','Activated', array('class' => 'col col-lg-2 control-label'))}}
            <div class="col col-lg-10">
                {{Form::checkbox('activated')}}
            </div>
        </div>
        <div class="row">
            {{Form::label('notify','Notify', array('class' => 'col col-lg-2 control-label'))}}
            <div class="col col-lg-10">
                {{Form::checkbox('notify')}}
                <p class="help-text">Notify user of changes.</p>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-10 col-offset-2">
                <button type="submit" class="btn btn-success">Update Account</button>
            </div>
        </div>
        {{Form::close()}}

    </div>
</div>

@stop