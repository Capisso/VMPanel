@extends('layouts/simple')

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

{{ Form::open(array('url' => 'account/login', 'class' => 'form-signin')) }}
<h2 class="form-signin-heading">Please sign in</h2>
<input type="text" class="input-block-level" name="email" placeholder="Email address" autofocus>
<input type="password" class="input-block-level" name="password" placeholder="Password">
<label class="checkbox">
    <input type="checkbox" name="remember" value="remember-me"> Remember me
</label>
<button class="btn btn-large btn-primary btn-block" type="submit">Sign in</button>
<br>
<p class="text-center">{{HTML::linkAction('AccountController@getForgot', 'Forgotten Password?')}}</p>
{{ Form::close() }}



@stop