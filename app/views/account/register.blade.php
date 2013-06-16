@extends('layouts.simple')

@section('content')
@if($errors->count() > 0)
<div class="alert alert-error">
    <ul>
        @foreach($errors->all() as $message)
        <li>{{$message}}</li>
        @endforeach
    </ul>
</div>
@endif

{{ Form::open(array('url' => 'account/register', 'class' => 'form-signin')) }}
<h2 class="form-signin-heading">Register</h2>
<input type="text" class="input-block-level" name="email" placeholder="Email address" autofocus>
<input type="text" class="input-block-level" name="username" placeholder="Username">
<input type="password" class="input-block-level" name="password" placeholder="Password">
<button class="btn btn-large btn-primary btn-block" type="submit">Create Account</button>
{{ Form::close() }}



@stop