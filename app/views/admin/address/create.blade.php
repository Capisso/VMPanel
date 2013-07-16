@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/address/partials/sidebar')
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

{{Form::open(array('action' => 'Admin\AddressController@store', 'class' => 'form-horizontal'))}}

<div class="control-group">
    {{ Form::label('addresses','Addresses', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::textarea('addresses', null, array('class' => 'input-block-level')) }}
        <p class="help-block">
            Addresses or blocks should be separated by line breaks. <br>
            You can specify single or multiple IP addresses via <strong>192.168.0.1/24</strong> or <strong>10.1.20.17-10.1.20.94</strong></p>

    </div>
</div>
<div class="control-group">
    <div class="controls">
        <button type="submit" class="btn btn-success">Add Addresses</button>
    </div>
</div>

{{ Form::close() }}



@stop
