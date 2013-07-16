@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/address/partials/sidebar')
@stop

@section('content')

<style>
    .column {
        -moz-column-count:3; /* Firefox */
        -webkit-column-count:3; /* Safari and Chrome */
        column-count:3;
    }
</style>

<table class="table column">
    <tbody class="">
        @foreach($addresses as $address)
        <tr>
            <td><a href=""></a> {{{ $address->address }}}</td>
        </tr>
        @endforeach 
    </tbody>
</table>









@stop