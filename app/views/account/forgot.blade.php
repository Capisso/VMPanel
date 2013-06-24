@extends('layouts/simple')

@section('content')

{{ Form::open(array('url' => 'account/forgot', 'class' => 'form-signin')) }}
<h2 class="form-signin-heading">Forgot Password?</h2>
<input type="text" class="input-block-level" name="email" placeholder="Email" autofocus>
<br>
<button class="btn btn-large btn-primary btn-block" type="submit">Reset</button>
<br>
<p class="text-center">{{HTML::linkAction('AccountController@getLogin', 'Back to Login')}}</p>
{{ Form::close() }}

@stop