@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/user/partials/sidebar')
@stop

@section('content')

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
            <td><i class="{{ ($user->primaryGroup()->name == 'Admins' ? 'icon-star' : 'icon-user' ) }}"></i> </td>
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


@stop