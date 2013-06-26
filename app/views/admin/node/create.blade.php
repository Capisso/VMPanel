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

        @if(!$pending)

        <div class="alert alert-danger">
            <h4>Error!</h4>
            <p>Your salt master is not setup properly.</p>
        </div>

        @else
        <div class="row">
            @foreach($pending as $p)
            <div class="col col-lg-4">
                <div class="thumbnail">
                    <img data-src="holder.js/300x200" alt="">
                    <div class="caption">
                        <h3>{{{ $p }}}</h3>
                        <p>We'll add more here to help identify your node.</p>
                        <p>
                            {{HTML::linkAction('Admin\NodeController@show', 'Accept', 1, array('class' => 'btn btn-success'))}}
                            {{HTML::linkAction('Admin\NodeController@show', 'Reject', 1, array('class' => 'btn btn-danger pull-right'))}}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>


@stop