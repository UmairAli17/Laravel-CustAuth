@extends('layouts.app')

@section('content')
	<div class="col-md-8 col-md-offset-2">
			@foreach($residences->business->residence as $residence)
				<div class="col-md-4">
					<h2>{{ $residence->name }}</h2>
					<p>{{ $residence->street }}</p>
					<p>{{ $residence->city }}</p>
					<p>{{ $residence->postcode }}</p>
					@can('edit_residence', $residence)<h3>Edit</h3>@endcan
				</div>
			@endforeach
	</div>
@endsection