@extends('layouts.app')

@section('content')
	<div class="col-md-8 col-md-offset-2"> 
		{!! Form::open(['action' => 'LandlordController@store_residence']) !!}
			<div class="form-group">
				{!! Form::label('name', 'Residence Name:') !!}
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
				{!! Form::submit('Add Residence'); !!}
			</div>
		{!! Form::close() !!}
	@include('errors.list')
	</div>
@endsection