@extends('layouts.app')

@section('content')
<div class="col-md-8 col-md-offset-2">
	<div class="panel-heading">
		{!! Form::model($business, ['method' => 'PATCH', 'files' => true, 'route' => ['business.update', $business->id]]) !!}
			<div class="form-group">
				{!! Form::label('name', 'Name:') !!}
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('description', 'Description:') !!}
				{!! Form::textarea('description', null, ['class'=>'form-control']) !!}
			</div>	

			{!! Form::file('logoFileName') !!}
			@if ($business->logoFileName)
				<img class="img-responsive" src="{{  asset('/uploads/logos') . '/' . $business->logoFileName }}"></div>
			@else
				<p>You need to upload a logo!</p>
			@endif
			<div class="form-group">
				{!! Form::submit('Update Business', ['class' => 'btn btn-primary form-control']) !!}
			</div>
		{!! Form::close() !!}
		@include('errors.list')
	</div>
</div>
@endsection