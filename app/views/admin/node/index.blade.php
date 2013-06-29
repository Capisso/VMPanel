@extends('layouts/admin')

@section('content')

<h2>Nodes</h2>

<div class="row">
    <div class="col col-lg-3">
        @include('admin/node/partials/sidebar')
    </div>

    <div class="col col-lg-9">
        <div class="row">
            @foreach($nodes as $node)

            <div class="col col-lg-4">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>{{{ $node->hostname }}}</h3>
                        <p>Some graph/chart</p>
                        <p>{{ HTML::linkAction('Admin\NodeController@show', 'Manage', array($node->id), array('class' => 'btn btn-primary')) }}</p>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</div>



@stop