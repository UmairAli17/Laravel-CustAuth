@extends('layouts.app')

@section('content')
	@include('search')
	@forelse($residences as $r)
		<div class="col-xs-12 col-md-4 resi-cards-all">
			<img src="#" class="img-responsive resi-cards-all-img">
			<a href="{{route('residence.view', ['id'=>$r->id])}}"><h2>{{$r->name}}</h2></a><br>
			{{$r->street}}<br>
			{{$r->postcode}}<br>
		</div>
	@empty
		<h2>No Residences Found....</h2>
	@endforelse
@endsection