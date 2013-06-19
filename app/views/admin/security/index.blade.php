@extends('layouts/admin')

@section('content')

<h2>Security Homepage</h2>
<p>We'll be adding more information here soon, for now view the individual modules on the left.</p>

<div class="row">
    <div class="col col-lg-3">
        @include('admin/security/sidebar')
    </div>

    <div class="col col-lg-9">

    </div>
</div>

@stop