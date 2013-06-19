@extends('layouts/admin')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th>Email</th>
            <th>Username</th>
            <th>Name</th>
            <th>Servers</th>
            <th>Created On</th>
            <th>Last Sign On</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>

        @foreach($users as $user)
        <tr>
            <td>{{{$user->email}}}</td>
            <td>{{{$user->username}}}</td>
            <td>{{{$user->first_name}}} {{{$user->last_name}}}</td>
            <td>30</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td>
                {{HTML::linkAction('Admin\UserController@show', 'Manage', array($user->id), array('class' => 'btn btn-default btn-small pull-right'))}}
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


@stop