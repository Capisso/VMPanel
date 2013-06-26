@extends('layouts/admin')

@section('content')

<h2>{{$title}}</h2>

<div class="row">
    <div class="col col-lg-3">
        @include('admin/node/partials/sidebar')
    </div>

    <div class="col col-lg-9">

        <p>Adding a node to your panel is super easy. Simply copy and paste the command below into the new server. You
            should run it as the root user.</p>

        <pre>wget -O - {{ URL::to('install/minion') }} | sudo sh</pre>

        <h3>Pending Nodes</h3>
        <p>Below is a list of pending nodes, please verify the node you're adding is owned by you.</p>

    </div>
</div>


@stop