@extends('layouts.app')

@section('content')

	<div class="col-md-8 col-md-offset-2">
		<div class="col-md-6">
		<h2>{{$residence->name}}</h2>
		<h3>{{$residence->street}}</h3>
		<h3>{{$residence->city}}</h3>
		</div>
		@can('edit_residence', $residence)
		<div class="col-md-2">
			<a href="{{route('residence.edit', ['id'=>$residence->id])}}">Edit</a>
		</div>
		@endcan
	</div>
	<div class="col-md-8 col-md-offset-2">
		<h1>Reviews</h1>
		@foreach($residence->posts as $reviews)
			<div class="col-md-12">
				<h3>Review by:{{$reviews->user->name}}
				<h4>{{$reviews->title}}</h4>
				@can('owns_post', $reviews) <a href="{{ route('posts.edit', $reviews->id) }}">Edit</a>@endcan</div>
			</div>
		@endforeach
	</div>
	<div class="col-md-8 col-md-offset-2">
		<h2>Would you like to leave a review?</h2>
		<div class="panel-heading">
		{!! Form::open(['route' => ['residence.store_residence_review', $residence->id], 'method' => 'POST']) !!}			
			<div class="form-group">
				{!! Form::label('title', 'Title:') !!}
				{!! Form::text('title', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('body', 'Main Text:') !!}
				{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
			</div>	

			<div class="form-group">
				{!! Form::submit('Submit Post', ['class' => 'btn btn-primary form-control']) !!}
			</div>
		{!! Form::close() !!}
		@include('errors.list')
	</div>
	</div>
@endsection