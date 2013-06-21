@extends('layouts/admin')

@section('content')

<h2>Add IP Addresses</h2>
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

        {{Form::open(array('action' => 'Admin\AddressController@store', 'class' => 'form-horizontal'))}}

        <div class="row">
            {{Form::label('addresses','Addresses', array('class' => 'col col-lg-2 control-label'))}}
            <div class="col col-lg-10">
                {{Form::textarea('addresses')}}
                <p class="help-text">Addresses or blocks should be separated by line breaks.</p>
                <p class="help-text">You can specify single or multiple IP addresses via <strong>192.168.0.1/24</strong> or <strong>10.1.20.17-10.1.20.94</strong></p>

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