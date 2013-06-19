@extends('layouts/admin')

@section('content')

<h2>Create IP Addresses</h2>
<p>You can create either a single IP Address or a block of IP addresses using the tool below.</p>


<br>
<div class="row">
    <div class="col col-lg-3">
        @include('admin/address/partials/sidebar')
    </div>

    <div class="col col-lg-9">
        @if($errors->count() > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $message)
                <li>{{$message}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{Form::open(array('action' => 'Admin\RegionController@store', 'class' => 'form-horizontal'))}}

        <div class="row">
            {{Form::label('name','Name', array('class' => 'col col-lg-2 control-label'))}}
            <div class="col col-lg-10">
                {{Form::text('name')}}
            </div>
        </div>
        <div class="row">
            {{Form::label('location','Location', array('class' => 'col col-lg-2 control-label'))}}
            <div class="col col-lg-10">
                {{Form::text('location')}}
                <p class="help-text">
                    Location is a descriptive reminder of where this region is, for use in maps and other analytics. <br>
                    <em>Examples:</em> "32.729819, -96.739967", "Dallas, Tx"
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-10 col-offset-2">
                <button type="submit" class="btn btn-success">Create Region</button>
            </div>
        </div>

        {{Form::close()}}
    </div>
</div>


@stop