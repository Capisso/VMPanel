@extends('layouts/admin')

@section('content')

<h2>Intrusion Detection System</h2>

<br>
<div class="row">
    <div class="col col-lg-3">
        @include('admin/security/sidebar')
    </div>

    <div class="col col-lg-9">

        <h3>{{{$event->name}}}</h3>

        <div class="btn-group">
            {{Form::open(array('method' => 'delete', 'class' => 'pull-right', 'action' => array('Admin\Security\IntrusionController@destroy', $event->id)))}}
            <a href="" class="btn btn-info btn-small">Report to Capisso</a>
            <input type="submit" class="btn btn-danger btn-small" value="Delete"/>
            {{Form::close()}}

        </div>

        <hr>


        <dl class="dl-horizontal">
            <dt>Impact Rating</dt>
            <dd>{{{$event->impact}}}</dd>

            <dt>Page</dt>
            <dd>{{{$event->page}}}</dd>

            <dt>IP Address</dt>
            <dd>{{{$event->ip}}}</dd>

            <dt>Time</dt>
            <dd>{{$event->created_at}}</dd>
        </dl>

        <h4>Requested Value</h4>
        <pre>{{{$event->value}}}</pre>

        <br>

        <h4>Additional Information</h4>
        <pre>{{{$event->request}}}</pre>
    </div>
</div>


@stop