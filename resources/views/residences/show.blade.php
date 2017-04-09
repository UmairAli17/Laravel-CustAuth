@extends('layouts.app')
@section('content')
		{{-- IMAGE & DETAILS ROW --}}
		<div class="row img-det-row">
			<div class="col-md-12">
				{{-- Residence Image --}}
				<div class="col-xs-12 resi-img-cont no-padding"><img class="img-responsive resi-image" src="{{  asset('/uploads') . '/' . $residence->image }}"></div>

			</div>
			<div class="row">
				<div class="col-md-6">
					<h2>{{$residence->name}}, {{$residence->street}}</h2>
					<h3>{{$residence->city}}</h3>
					<h4 class="capitalise">{{$residence->postcode}}</h4>
					@can('landlord_owner', $residence)
						<div class="no-padding col-xs-4 no-padding">
							<a href="{{route('residence.edit', ['id'=>$residence->id])}}">Edit Residence</a>
							{!! Form::open(['route' => ['residence.delete', $residence->id], 'method'=> 'PATCH']) !!}
									<button type="submit" class="btn btn-default" name="post_rating" id="post_rating"><span class="ion-trash-b"></span></button>
								{!! FORM::close() !!}
						</div>
					@endcan

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
				{{-- @can('can_review') --}}
				<div class="col-md-6">
					<h2>Landlord: Business Details</h2>
					<h3>Business Name: {{$residence->landlord_business->name}}</h3>
					<h3>Owner: <a href="{{route('user.profile', [$residence->landlord_business->user->id])}}">{{$residence->landlord_business->user->name}}</a></h3>
				</div>
				{{-- @endcan --}}
			</div>
		</div>
		{{-- END IMAGE & DETAILS ROW --}}

		{{-- REVIEWS & FORM ROW --}}
		<div class="row">
			@can('can_review')
				@include('residences.add')
			@endcan
			@include('residences.reviews')
		</div>
		
@endsection


	@section('scripts')


		$(".reply_btn").click(function(e) {
            $(e.target).next(".reply_form").toggle();
        });


		// var initMap = function()
		// {
		// 	/*
		// 		Set the event coordinates (lat, lng) to an object: event_coords
		// 	 */
		// 	var res_coords = {!! $postcode !!};
		// 		navigator.geolocation.getCurrentPosition(function (position) { 
		        
		// 		    var lat = position.coords.latitude;                    
		// 		    var long = position.coords.longitude;                 
		// 		    var coords = new google.maps.LatLng(lat, long);

		// 		    var directionsService = new google.maps.DirectionsService();
		// 		    var directionsDisplay = new google.maps.DirectionsRenderer();
				  
		// 		    var map = new google.maps.Map($("#map")[0], {
		// 	          zoom: 15,
		// 	          center: coords
		// 	        });
			  
		  
		// 	     	directionsDisplay.setMap(map);
		// 		    var request = {
		// 		       origin:coords, 
		// 		       destination: res_coords,
		// 		       travelMode: google.maps.TravelMode.DRIVING,
		// 		     };

		// 		    directionsService.route(request, function (response, status) {
		// 		       if (status == google.maps.DirectionsStatus.OK) {
		// 		        	directionsDisplay.setDirections(response);
		// 		    	}
		// 		    });         
		// 		});
			

			// OR ONLY THE POSITION OF THE RESIDENCE!!
			// var res_coords = {!! $postcode !!};
	  //       var map = new google.maps.Map($("#map")[0], {
		 //          zoom: 15,
		 //          center: res_coords
		 //        });
	  //        var marker = new google.maps.Marker({
	  //          position: res_coords,
	  //          map: map
	  //       });
	  //}
		
	@endsection

	{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYYnhRa-OxUlNUTfDZbCTPxrUyMWCFo4A&callback=initMap"
  type="text/javascript"></script> --}}
	
