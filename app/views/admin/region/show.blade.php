@extends('layouts/admin')

@section('content')


<h2>Create New Region</h2>


<br>
<div class="row">
    <div class="col col-lg-3">
        @include('admin/region/partials/sidebar')
    </div>

    <div class="col col-lg-9">
        <h2>{{{$region->name}}}</h2>
        <div class="btn-group">
            {{Form::open(array('method' => 'delete', 'class' => 'pull-right', 'action' => array('Admin\RegionController@destroy', $region->id)))}}
            {{HTML::linkAction('Admin\RegionController@edit', 'Edit', array($region->id), array('class' => 'btn btn-default'))}}
            <input type="submit" class="btn btn-danger" value="Delete"/>
            {{Form::close()}}

        </div>

        <hr>
        <dl class="dl-horizontal">
            <dt>Location</dt>
            <dd>{{{$region->location}}}</dd>

            <dt>Created</dt>
            <dd>{{$region->created_at}}</dd>
        </dl>

        <br>

        <h4>Nodes</h4>
        <div class="row">
            @foreach($region->nodes as $node)

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