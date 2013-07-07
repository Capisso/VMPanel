@extends('templates/admin/sidebar')

@section('sidebar')
    @include('admin/plan/partials/sidebar')
@stop

@section('content')


<h4>General Options</h4>
{{ Form::open(array('action' => 'Admin\PlanController@store', 'class' => 'form-horizontal')) }}
<div class="control-group">
    {{ Form::label('name','Name', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::text('name') }}
    </div>
</div>

<div class="control-group">
    {{ Form::label('type','Type', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::select('type', array(
                                    'xen' => 'Xen',
                                    'openvz' => 'OpenVZ',
                                    'kvm' => 'KVM'
                                )) }}
    </div>
</div>

<h4>Resource Specifications</h4>


    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#memory" data-toggle="tab">Memory</a></li>
        <li><a href="#network" data-toggle="tab">Network</a></li>
        <li><a href="#disk" data-toggle="tab">Disk</a></li>
        <li><a href="#cpu" data-toggle="tab">CPU</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="memory">

            <br>

            <div class="control-group">
                {{ Form::label('mem_initial','Initial Memory', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('mem_initial') }}
                    <p class="help-block">Default ram allocation in bytes.</p>
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('mem_burst','Burst Memory', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('mem_burst') }}
                    <p class="help-block">Allowable burst ram, if applicable in bytes.</p>
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('mem_swap','Swap Memory', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('mem_swap') }}
                    <p class="help-block">Swap memory, in bytes.</p>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="network">

            <br>

            <div class="control-group">
                {{ Form::label('network_bandwidth','Allocated Bandwidth', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('network_bandwidth') }}
                    <p class="help-block">Maximum bandwidth allocated to server, in bytes.</p>
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('network_throughput','Network Throughput', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('network_throughput') }}
                    <p class="help-block">Allocated network throughput, in bytes.</p>
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('network_ipv4','IPv4 Addresses', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('network_ipv4') }}
                    <p class="help-block">Number of IPv4 addresses</p>
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('network_ipv6','IPv6 Addresses', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('network_ipv6') }}
                    <p class="help-block">Number of IPv6 addresses</p>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="disk">

            <br>

            <div class="control-group">
                {{ Form::label('disk_size','Disk Size', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('disk_size') }}
                    <p class="help-block">Disk size in bytes.</p>
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('disk_throughput','Disk Throughput', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('disk_throughput') }}
                    <p class="help-block">Maximum throughput of disk, in bytes.</p>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="cpu">

            <br>

            <div class="control-group">
                {{ Form::label('cpu_cores','CPU Cores', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('cpu_cores') }}
                    <p class="help-block">Number of cores allocated to server.</p>
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('cpu_priority','CPU Priority', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text('cpu_priority', 0) }}
                    <p class="help-block">Input as a NICE value, range is -20 to 19.  </p>
                </div>
            </div>

        </div>
    </div>

<h4>Plan Flags</h4>

<div class="control-group">
    {{ Form::label('active','Active', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::checkbox('active', true) }}
    </div>
</div>

<div class="control-group">
    {{ Form::label('suspend_overbandwidth','Suspend Bandwidth', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::checkbox('suspend_overbandwidth', true) }}
        <p class="help-block">Do we suspend at 100% Bandwidth?</p>
    </div>
</div>

<div class="control-group">
    {{ Form::label('reinstallable','Reinstablle', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::checkbox('reinstallable', true) }}
        <p class="help-block">Can a user reinstall a server on this plan?</p>
    </div>
</div>




<div class="control-group">
    <div class="col col-lg-10 col-offset-2">
        <button type="submit" class="btn btn-success">Create Plan</button>
    </div>
</div>
{{  Form::close()  }}


@stop