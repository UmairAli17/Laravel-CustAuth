@extends('layouts.app')

@section('content')
			@forelse($residences->business->residence as $residence)
				<div class="col-xs-12 col-md-4 resi-cards-all">
					<img src="{{  asset('/uploads') . '/' . $residence->image }}" class="img-responsive resi-cards-all-img">
					<h2><a href="{{route('residence.view', ['id'=>$residence->id])}}">{{ $residence->name }}</a></h2>
					<p>{{ $residence->street }}</p>
					<p>{{ $residence->city }}</p>
					<p>{{ $residence->postcode }}</p>

					<div class="no-padding col-xs-4 no-padding">
						<a href="{{route('residence.edit', ['id'=>$residence->id])}}">Edit Residence</a>
						{!! Form::open(['route' => ['residence.delete', $residence->id], 'method'=> 'PATCH']) !!}
							<button type="submit" class="btn btn-default" name="post_rating" id="post_rating"><span class="ion-trash-b"></span></button>
						{!! FORM::close() !!}
					</div>
				</div>
			@empty
				<h2>Hey! Looks like you need to start adding residences to your Account!</h2>
			@endforelse
	</div>
@endsection