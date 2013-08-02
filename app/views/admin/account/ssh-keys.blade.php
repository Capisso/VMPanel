@extends('templates/admin/sidebar')


@section('content')


<a href="#addKey" role="button" class="btn btn-info pull-right" data-toggle="modal">Add SSH Key</a>

<div class="clearfix"></div>
<br>

<div class="accordion" id="sshKeys">
	@foreach($keys as $key)
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#sshKeys" href="#collapse{{ $key->id }}">
				{{{ $key->name }}}
			</a>
		</div>
		<div id="collapse{{ $key->id }}" class="accordion-body collapse in">
			<div class="accordion-inner">
				<div class="pull-left">
					<p>Added on {{{ $key->created_at }}}</p>
				</div>
				<div class="pull-right">
					{{ Form::open(array('method' => 'delete', 'action' => array('Admin\AccountController@deleteSshKeys', $key->id))) }}
					<input type="submit" class="btn btn-danger" value="Delete"/>
					{{Form::close()}}
				</div>
				<div class="clearfix"></div>
				<pre>{{{ $key->key }}}</pre>
			</div>
		</div>
	</div>
	@endforeach
</div>


<div id="addKey" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="addKeyLabel" aria-hidden="true">

	{{ Form::open(array('action' => 'Admin\AccountController@postSshKeys', 'style' => 'margin-bottom: 0px')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Add SSH Key</h3>
	</div>
	<div class="modal-body">

		<div class="control-group">
			{{ Form::label('name', 'Name', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text('name') }}
			</div>
		</div>
		<div class="control-group">
			{{ Form::label('key','Public Key', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::textarea('key', null, array('rows' => 5, 'class' => 'input-block-level')) }}
			</div>
		</div>

	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary">Add Key</button>
	</div>
	{{ Form::close() }}
</div>


@stop
