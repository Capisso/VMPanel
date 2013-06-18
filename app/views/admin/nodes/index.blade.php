@extends('layouts/admin')

@section('content')

<div class="row">
    @for($i = 0; $i < 20; $i++)
    <div class="col col-lg-3">
        <div class="thumbnail">
            <img data-src="holder.js/300x200" alt="">
            <div class="caption">
                <h3>dal{{$i}}.provider.com</h3>
                <p>Some graph/chart</p>
                <p>{{HTML::linkAction('Admin\NodesController@show', 'Manage', array($i), array('class' => 'btn btn-primary'))}}</p>
            </div>
        </div>
    </div>
@if((($i + 1) % 4 == 0))
</div>
<br>
<div class="row">
@endif

    @endfor
</div>

@stop