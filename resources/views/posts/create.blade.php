@extends('layouts.app')

@section('content')
<div class="col-md-8 col-md-offset-2">
	<div class="panel-heading">
			{!! Form::model($post, ['action' => 'PostsController@store']) !!}			
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
@endsection()