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

<div class="row">
    <div class="span3">
        @yield('sidebar')
    </div>
    <div class="span9">
        @yield('content')
    </div>
</div>

@stop