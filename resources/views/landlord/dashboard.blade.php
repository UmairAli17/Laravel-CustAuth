@extends('layouts.app')

@section('content')
	@include('nav.accountSide')
	<div class="col-md-8">
		<h1 class="landTitlesLarge">Hello there! This is the Landlord Dashboard</h1>
		<h2>Manage Landlord Business</h2>

		<div class="col-md-4 cards">
			@can('add-landlord-residence')<a href="{{ route('landlord.my_residences')}}"><span class="card-items">See my residences</span></a>@endcan
		</div>

		
		<div class="col-md-4 cards">
			@can('add-landlord-residence')<a href="{{ route('landlord.add')}}"><span class="card-items">Add Residence</span></a>@endcan
		</div>

		
	</div>
@endsection