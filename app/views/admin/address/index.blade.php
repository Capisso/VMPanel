@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/address/partials/sidebar')
@stop

@section('content')

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
