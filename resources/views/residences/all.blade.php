@extends('layouts.app')

@section('content')
	<h1 class="resi-header">RentSafe: Search</h1>
	@include('search')
	@forelse($residences as $r)
		<div class="col-xs-12 col-md-4">
			<div class="col-xs-12 resi-cards-all">
				<img src="{{  asset('/uploads') . '/' . $r->image }}" class="img-responsive resi-cards-all-img">
				<a href="{{route('residence.view', ['id' => $r->id])}}"><h2>{{$r->name}}</h2></a><br>
				{{$r->street}}<br>
				<div class="capitalise"> {{$r->postcode}}</div><br>
				@if($r->rating == 0)
						<span class="glyphicon glyphicon-thumbs-left"></span><span class="glyphicon glyphicon-thumbs-right"></span>Neutral User Ratings
					@elseif($r->rating > 0)
							<span class="ion-thumbsup"></span>Good User Ratings
					@elseif($r->rating < 0)
							<span class="ion-thumbsdown icon-res"></span>
					@endif
			</div>
		</div>
	@empty
		<h2>No Residences Found....</h2>
	@endforelse
@endsection


	