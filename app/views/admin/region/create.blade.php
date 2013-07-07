@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/region/partials/sidebar')
@stop

@section('content')

@if($errors->count() > 0)
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $message)
        <li>{{$message}}</li>
        @endforeach
    </ul>
</div>
@endif

{{ Form::open(array('action' => 'Admin\RegionController@store', 'class' => 'form-horizontal')) }}
    <div class="control-group">
        {{ Form::label('name','Name', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::text('name') }}
        </div>
    </div>
    <div class="control-group">
        {{ Form::label('location','Location', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::text('location') }}
            <p class="help-block">
                Location is a descriptive reminder of where this region is, for use in maps and other analytics. <br>
                <em>Examples:</em> "32.729819, -96.739967", "Dallas, Tx"
            </p>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-success">Create Region</button>
        </div>
    </div>
{{ Form::close() }}

@stop