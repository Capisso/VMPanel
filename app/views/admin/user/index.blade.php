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
                    <th>Email</th>
                    <th>Username</th>
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

    </div>
</div>

@stop