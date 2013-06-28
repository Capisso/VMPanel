@extends('layouts/admin')

@section('content')

<h2>Users</h2>

<br>
<div class="row">
    <div class="col col-lg-3">
        @include('admin/user/partials/sidebar')
    </div>

    <div class="col col-lg-9">

        <table class="table">
            <thead>
                <tr>
                    <td>Group</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Created At</td>
                    <td>Last Login</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{{ $user->primaryGroup()->name }}}</td>
                    <td>{{ HTML::linkAction('Admin\UserController@show', e($user->username), array($user->id)) }}</td>
                    <td>{{{ $user->email }}}</td>
                    <td>{{{ $user->created_at }}}</td>
                    <td>{{{ $user->updated_at }}}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'action' => array('Admin\UserController@destroy', $user->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-small')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@stop