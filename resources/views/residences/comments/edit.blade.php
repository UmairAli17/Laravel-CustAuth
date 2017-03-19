@extends('layouts.app')

@section('content')
<div class="col-xs-12 col-md-8 col-md-offset-2">
{!! Form::model($c, ['method' => 'PATCH', 'route' => ['comment.update', $c->id]]) !!}
			<div class="form-group">
				{!! Form::label('comment', 'Comment:') !!}
				{!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
				<div class="form-group">
				{!! Form::submit('Update Comment', ['class' => 'btn btn-primary form-control']) !!}
			</div>
			</div>
		{!! Form::close() !!}
		@include('errors.list')
</div>
@endsection