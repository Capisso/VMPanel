@extends('layouts/simple')

@section('content')
<div class="form-signin">
    <h2 class="form-signin-heading text-center">Fatal Error</h2>
    <p>Something is wrong with this request, so we're killing it. I recommend going back and trying again.</p>

    <a href="javascript:history.back()">Back</a>
</div>

@stop