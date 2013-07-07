@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/security/partials/sidebar')
@stop

@section('content')

<h2>Intrusion Detection System</h2>
<p>This system automatically detects attempted SQL Injection/XSS exploits made against your panel. You can view more
    information about the event or report it to Capisso by clicking view.</p>

<table class="table">

    <thead>
        <tr>
            <th></th>
            <th>Impact</th>
            <th>Name</th>
            <th>Value</th>
            <th>IP Address</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td></td>
            <td>{{{ $event->impact }}}</td>
            <td>{{{ Str::limit($event->name, 20) }}}</td>
            <td>
                @foreach(json_decode($event->tags) as $tag)
                {{{ $tag }}}
                @endforeach
            </td>
            <td>{{{ $event->ip }}}</td>
            <td class="text-right">
                {{ Form::open(array('method' => 'delete', 'action' => array('Admin\Security\IntrusionController@destroy', $event->id))) }}
                    {{ HTML::linkAction('Admin\Security\IntrusionController@show', 'View', $event->id, array('class' => 'btn btn-primary btn-small')) }}
                <input type="submit" class="btn btn-danger btn-small" value="Delete"/>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
    </tbody>

</table>



@stop