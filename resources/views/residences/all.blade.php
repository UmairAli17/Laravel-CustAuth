@extends('layouts.app')

@section('content')
	<h1 class="resi-header">RentSafe: Search</h1>
	@include('search')
	@forelse($residences as $r)
		<div class="col-xs-12 col-md-4">
		<img src="{{  asset('/uploads') . '/'. $r->image }}" class="img-responsive resi-cards-all-img">
			<div class="col-xs-12 resi-cards-all">
				
				<a href="{{route('residence.view', ['id' => $r->id])}}"><h2>{{$r->name}}, {{$r->street}}</h2></a><br>
				<div class="capitalise"> {{$r->postcode}}</div><br>
				<h5>Average User Rating:</h5>
				@if($r->rating == 0)
					<span class="glyphicon glyphicon-thumbs-left"></span><span class="glyphicon glyphicon-thumbs-right"></span>Neutral User Ratings
					@elseif($r->rating > 0)
							<span class="ion-thumbsup"></span>
					@elseif($r->rating < 0)
							<span class="ion-thumbsdown icon-res"></span>
					@endif
			</div>
		</div>
	@empty
		<h2 style="    text-align: center;
    margin-top: 2.5em;">No Residences Found....</h2>
	@endforelse
@endsection


	