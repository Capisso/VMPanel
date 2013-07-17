@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/address/partials/sidebar')
@stop

@section('content')

<ul id="addresses" class="nav nav-tabs">
    <li class="active"><a href="#ipv4" data-toggle="tab">IPv4</a></li>
    <li><a href="#ipv6" data-toggle="tab">IPv6</a></li>
</ul>
<div id="addressesContent" class="tab-content">
    <div class="tab-pane fade in active" id="ipv4">
        <table class="table">
            <thead>
                <tr>
                    <td>Address</td>
                    <td>Server</td>
                    <td>Node</td>
                </tr>
            </thead>
            <tbody class="">
                @foreach($addresses['ipv4'] as $address)
                <tr>
                    <td>{{ HTML::linkAction('Admin\AddressController@show', $address->address, array($address->address)) }}</td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="ipv6">
        <table class="table">
            <thead>
                <tr>
                    <td>Address</td>
                    <td>Server</td>
                    <td>Node</td>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses['ipv6'] as $address)
                <tr>
                    <td><a href=""></a> {{{ $address->address }}}</td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>



@stop
