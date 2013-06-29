@extends('layouts/admin')

@section('content')

<h2>{{$title}}</h2>

<div class="row">
    <div class="col col-lg-3">
        @include('admin/node/partials/sidebar')
    </div>

    <div class="col col-lg-9">

        @if(count($regions) == 0) 
        <div class="alert alert-danger">
            <h4>Stop!</h4>
            <p>You'll need some regions before you try and create a node.</p>
        </div>
        @endif 


        <p>Adding a node to your panel is super easy. Simply copy and paste the command below into the new server. You
            should run it as the root user.</p>

        <pre>wget -O - {{ URL::to('install/minion') }} | sudo sh</pre>

        <h3>Pending Nodes</h3>
        <p>Below is a list of pending nodes, please verify the node you're adding is owned by you.</p>

        @if($pending === false)

        <div class="alert alert-danger">
            <h4>Error!</h4>
            <p>Your salt master is not setup properly.</p>
        </div>

        @elseif(count($pending) == 0)

        <p>No pending nodes.</p>

        @else
        <div class="row">
            @foreach($pending as $p)
            <div class="col col-lg-4">
                <div class="thumbnail">
                    <img data-src="holder.js/300x200" alt="">
                    <div class="caption">
                        <h3>{{{ $p }}}</h3>
                        <p>We'll add more here to help identify your node.</p>
                        <div class="row">
                            <div class="col col-lg-6">
                                <a href="#{{{$p}}}Modal" data-toggle="modal" class="btn btn-success">Accept</a>
                            </div>
                            <div class="col col-lg-6">
                                {{ Form::open(array('method' => 'post', 'action' => 'Admin\NodeController@store', 'class' => 'pull-right')) }}
                                {{ Form::input('hidden', 'hostname', $p) }}
                                {{ Form::input('submit', 'action', 'Reject', array('class' => 'btn btn-danger')) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="{{{$p}}}Modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Accept: {{{ $p }}}</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('method' => 'post', 'action' => 'Admin\NodeController@store', 'class' => 'form-horizontal')) }}
                                <div class="row">
                                    {{ Form::label('hostname', 'Hostname', array('class' => 'col col-lg-2 control-label')) }}
                                    <div class="col col-lg-10">
                                        {{ Form::input('text', 'hostname', $p, array('disabled', 'id' => 'disabledInput')) }}
                                    </div>
                                </div>

                                <div class="row">
                                    {{ Form::label('region', 'Region', array('class' => 'col col-lg-2 control-label')) }}
                                    <div class="col col-lg-10">
                                        {{ Form::select('region', $regions) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-lg-10 col-offset-2">
                                        {{ Form::hidden('hostname', $p) }}
                                        {{ Form::input('submit', 'action', 'Accept', array('class' => 'btn btn-success')) }}
                                    </div>
                                </div>
                            {{ Form::close() }}

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->

            @endforeach
        </div>
        @endif

    </div>
</div>


@stop