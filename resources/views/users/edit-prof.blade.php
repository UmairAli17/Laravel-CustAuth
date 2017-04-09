@extends('layouts.app')

@section('content')
	<h1>Edit Profile</h1>
	{!! Form::model($profile, ['method' => 'PATCH', 'files' => true, 'route' => ['profile.edit', $profile->id]]) !!}
		<div class="form-group">
		    {!! Form::label('gender', 'Select Gender') !!}
		    {!! Form::select('gender', ['N/A' => 'N/A', 'male' => 'Male',   'female' => 'Female', 'transgender' => 'Transgender'], null, ['id' => 'gender', 'class' => 'form-control', 'required' => 'required']) !!}
		</div>

	    <div class="form-group">
	        {!! Form::label('occupation', 'Occupation Status') !!}
	        {!! Form::text('occupation', null, ['class' => 'form-control']) !!}
	    </div>

	    <div class="form-group">
	        {!! Form::label('education', 'Education Status') !!}
	        {!! Form::text('education', null, ['class' => 'form-control']) !!}
	    </div>

	    <div class="form-group">
	        {!! Form::label('location', 'Place of Residence') !!}
	        {!! Form::text('location', null, ['class' => 'form-control']) !!}
	    </div>
		{!! Form::file('image') !!}
		<div class="btn-group pull-right">
			{!! Form::submit("Update Profile", ['class' => 'btn btn-Add']) !!}
		</div>
	
	{!! Form::close() !!}
@endsection