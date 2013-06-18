@extends('layouts/admin')

@section('content')

<table class="table">

    <thead>
        <tr>
            <th>Impact</th>
            <th>Name</th>
            <th>Value</th>
            <th>Name</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>{{$event->impact}}</td>
            <td>{{$event->name}}</td>
            <td>{{$event->value}}</td>
            <td>{{$event->tags}}</td>
            <td><button class="btn btn-primary btn-small pull-right">View</button></td>
        </tr>
        @endforeach
    </tbody>

</table>

@stop