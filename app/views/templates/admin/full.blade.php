@extends('layouts/admin')

@section('output')

@if(isset($title))
<div class="page-header">
    <h1>{{{ $title }}} 
        @if(isset($subtitle))
        <small>{{{ $subtitle }}}</small>
        @endif
    </h1>
</div>
@endif


@yield('content')

@stop