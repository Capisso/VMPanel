@extends('layouts/admin')

@section('content')

<h2>Intrusion Detection System</h2>

<br>
<div class="row">
    <div class="col col-lg-3">
        @include('admin/security/sidebar')
    </div>

    <div class="col col-lg-9">
        {{$event}}
    </div>
</div>


@stop