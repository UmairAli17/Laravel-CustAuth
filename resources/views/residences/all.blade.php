@extends('layouts.app')

@section('content')
	<div class="col-md-8 col-md-offset-2"> 
	@foreach($residences as $r)
		<a href="{{route('residence.view', ['id'=>$r->id])}}"><h2>{{$r->name}}</h2></a><br>
		{{$r->street}}<br>
		{{$r->postcode}}<br>
	@endforeach
	</div>
@endsection