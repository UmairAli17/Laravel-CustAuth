@extends('layouts.app')

@section('content')
<div class="col-md-8 col-md-offset-2">
	<div class="panel-heading">
		{!! Form::model($residence, ['method' => 'PATCH', 'route' => ['residence.update', $residence->id]]) !!}
			<div class="form-group">
				{!! Form::label('name', 'Name:') !!}
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('street', 'Street:') !!}
				{!! Form::text('street', null, ['class'=>'form-control']) !!}
			</div>	

			<div class="form-group">
				{!! Form::label('city', 'City:') !!}
				{!! Form::text('city', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('postcode', 'Postcode:') !!}
				{!! Form::text('postcode', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Update Residence', ['class' => 'btn btn-primary form-control']) !!}
			</div>
		{!! Form::close() !!}
		@include('errors.list')
	</div>
</div>
@endsection
