@extends('layouts/admin')

@section('content')

<h2>Users</h2>

<br>
<div class="row">
    <div class="col col-lg-3">
        @include('admin/user/partials/sidebar')
    </div>

    <div class="col col-lg-9">

        Find: <a href="#" data-filter="all:admins" data-grid="main">Admins</a>

        <ul class="applied" data-grid="main">
            <li data-template>
                [? if column == undefined ?]
                [[ valueLabel ]]
                [? else ?]
                [[ valueLabel ]] in [[ columnLabel ]]
                [? endif ?]
            </li>
        </ul>

        <table class="table results" data-grid="main" data-source="{{URL::action('ApiVersionOne\Admin\UserController@index')}}">
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
                <tr data-template>
                    <td></td>
                    <td>[[ username ]]</td>
                    <td>[[ email ]]</td>
                    <td>[[ created_at ]]</td>
                    <td>[[ updated_at ]]</td>

                </tr>
            </tbody>
        </table>

        <ul class="pagination" data-grid="main">
            <li data-template data-if-infinite data-page="[[ page ]]"<a href="#">>Load More</a></li>
            <li data-template data-if-throttle data-throttle><a href="#">[[ label ]]</a></li>
            <li data-template data-page="[[ page ]]"><a href="#">[[ pageStart ]] - [[ pageLimit ]]</a></li>
        </ul>

    </div>
</div>

@stop