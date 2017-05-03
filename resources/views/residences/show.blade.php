@extends('layouts.app')
@section('content')
		{{-- IMAGE and DETAILS ROW --}}
		<div class="row">
			<div class="col-md-6">
				{{-- Residence Image --}}
				<div class="resi-img-cont no-padding"><img class="img-thumbnail img-responsive resi-image" src="{{  asset('/uploads') . '/' . $residence->image }}"></div>

			</div>
				<div class="col-xs-12 col-md-6 info-card">
					<div class="col-md-12">
					<h2>{{$residence->name}}, {{$residence->street}}</h2>
					<h3>{{$residence->city}}</h3>
					<h4 class="capitalise">{{$residence->postcode}}</h4>
					

					<div class="in-ratings-cont">
						<p style="font-size: 1.5em;">Vote on Residence</p>
						{!! Form::open(['route' => ['residence.upvote', $residence->id], 'method'=> 'POST']) !!}
							<button type="submit" class="btn btn-default " name="rating" id="rating post-up-btn"><span class="glyphicon glyphicon-arrow-up"></span></button>
						{!! FORM::close() !!}
						{!! Form::open(['route' => ['residence.downvote', $residence->id], 'method'=> 'POST']) !!}
							<button type="submit" class="btn btn-default " name="rating" id="rating post-up-btn"><span class="glyphicon glyphicon-arrow-down"></span></button>
						{!! FORM::close() !!}
					</div> 
				</div>
					<div class="col-md-6">
						<h2>Landlord: Business Details</h2>
						<h3>Business Name:<a href="{{route('business.profile', [$residence->landlord_business->id])}}">{{$residence->landlord_business->name}}</a></h3>
						<h3>Owner: <a href="{{route('user.profile', [$residence->landlord_business->user->id])}}">{{$residence->landlord_business->user->name}}</a></h3>
					</div>
					@can('landlord_owner', $residence)
						<div class="col-xs-12">
							<a href="{{route('residence.edit', ['id'=>$residence->id])}}">Edit Residence</a>
							{!! Form::open(['route' => ['residence.delete', $residence->id], 'method'=> 'PATCH']) !!}
									<button type="submit" class="btn btn-default" name="post_rating" id="post_rating"><span class="ion-trash-b"></span></button>
								{!! FORM::close() !!}
						</div>
					@endcan
				</div>
		</div>
		{{-- END IMAGE and DETAILS ROW --}}

		{{-- REVIEWS and FORM ROW --}}
		<div class="row">
			<div class="col-xs-12">
				@can('student')
					<a class="btn btn-success" href="{{route('residence.review', ['id' => $residence->id])}}">Add Review</a>
				@endcan
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				@include('residences.reviews')
			</div>
		</div>
@endsection

	
@section('scripts')
  		$(".reply_btn").click(function(e) {
              $(e.target).next(".reply_form").toggle();
          });
@endsection