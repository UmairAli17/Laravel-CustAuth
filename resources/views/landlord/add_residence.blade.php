@extends('layouts.app')

@section('content')
	<div class="col-md-6">
	{!! Form::open(['route' => 'residence.store', 'method' => 'POST', 'files' => true]) !!}
			<div class="form-group">
				{!! Form::label('name', 'Residence Name:') !!}
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('street', 'Street:') !!}
				{!! Form::text('street', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('city', 'Town/City:') !!}
				{!! Form::text('city', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('postcode', 'Postcode:') !!}
				{!! Form::text('postcode', null, ['class'=>'form-control postcode']) !!}
			</div>

			{!! Form::file('image', ['class'=>'form-control']) !!}

			<div class="form-group">
				{!! Form::submit('Add Residence', ['class' => 'btn btn-success']); !!}
			</div>
		{!! Form::close() !!}
	@include('errors.list')
	</div>
	<div class="col-md-6">
		<h1>Create New <br>Residence!</h1>
	</div>
@endsection