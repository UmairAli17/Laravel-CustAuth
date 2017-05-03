@extends('layouts.app')

@section('content')
<div class="col-md-6">
	<h1>Care to Leave a Review?</h1>
</div>
<div class="col-xs-12 col-md-6 no-padding">
{!! Form::open(['route' => ['residence.store_residence_review', $residence->id], 'method' => 'POST']) !!}			
	<div class="form-group">
		{!! Form::label('rating', 'Rate Residence:') !!}
		{!! Form::select('rating', ['0' => 'Select Rating',	 '1' => '1', '2' => '2',   '3' => '3', '4' => '4', '5' => '5'], null, ['class'=>'form-control rating-select']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('title', 'Title:') !!}
		{!! Form::text('title', null, ['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('body', 'Main Text:') !!}
		{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
	</div>	

	<div class="form-group">
		{!! Form::submit('Submit Post', ['class' => 'add-review-btn']) !!}
	</div>
{!! Form::close() !!}
@include('errors.list')
</div>


@endsection
