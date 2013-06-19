@extends('layouts/admin')

@section('content')

<h2>{{{$user->username}}}</h2>

<hr>



{{$user}}

@stop