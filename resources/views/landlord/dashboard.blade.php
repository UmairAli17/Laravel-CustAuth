@extends('layouts.app')

@section('content')
		<h1 class="dash-header">Landlord Dashboard</h1>
		<div class="col-md-6 cards">
			@can('landlord')<a class="no-underline"  href="{{route('business.edit', ['id'=> Auth::user()->business->id])}}">
				<span class="card-items">
				<span style="font-size: 5em; display: flex; justify-content: center;" class="ion-briefcase"></span>Edit Business Details
				</span>
			</a>
			@endcan
		</div>

		<div class="col-md-6 cards">
			@can('landlord')<a class="no-underline" href="{{ route('landlord.my_residences')}}"><span class="card-items">
			<span style="font-size: 5em; display: flex; justify-content: center;" class="ion-ios-home"></span>See my residences</span></a>@endcan
		</div>

		
		<div class="col-md-6 cards">
			@can('landlord')<a class="no-underline" href="{{ route('residence.add')}}"><span class="card-items"><span style="font-size: 5em; display: flex; justify-content: center;" class="ion-ios-home-outline"></span>Add Residence</span></span></a>@endcan
		</div>

		
@endsection