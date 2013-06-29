@extends('layouts/admin')

@section('content')

<h2>Welcome {{{ Sentry::getUser()->username }}}</h2>

<div class="row">

<div class="col col-lg-4 col-offset-8">
    <div class="panel panel-primary">
        <div class="panel-heading">Active Nodes</div>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <td>Hostname</td>
                    <td>Servers</td>
                </tr>
            </thead>
            <tbody>
                @foreach($nodes as $node)
                <tr>
                    <td>{{{ $node->hostname }}}</td>
                    <td>{{{ count($node->servers) }}}}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
</div>

</div>

@stop