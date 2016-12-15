@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel-heading">
				{!! Form::model($business, ['action' => 'LandlordController@store']) !!}			
				<div class="form-group">
					{!! Form::label('name', 'Business Name:') !!}
					{!! Form::text('name', null, ['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('description', 'Business Description:') !!}
					{!! Form::textarea('description', null, ['class'=>'form-control']) !!}
				</div>	

				<div class="form-group">
					{!! Form::submit('Submit Post', ['class' => 'btn btn-primary form-control']) !!}
				</div>
			{!! Form::close() !!}
			@include('errors.list')
		</div>
</div>
	</div>
@endsection