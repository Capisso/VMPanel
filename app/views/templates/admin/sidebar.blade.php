@extends('layouts/admin')

@section('output')

<br><br>


<div class="row">
    <div class="span3">
        @yield('sidebar')
    </div>
    <div class="span9">
        @if(isset($title))
        <div class="page-header">
            <h1>{{{ $title }}}</h1>
            <p>{{ (isset($description) ? $description : '' ) }}</p>
        </div>
        @endif

        @yield('content')
    </div>
</div>

@stop