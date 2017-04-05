@extends('layouts.full')

@section('content')
		<div class="row">
			<div class="col-xs-12 col-md-10 col-md-offset-1 resi-img-cont"><img class="img-responsive resi-image" src="{{  asset('/uploads') . '/' . $residence->image }}"></div>
				<div class="col-xs-12 col-md-10 col-md-offset-1 no-padding">
					<div class="col-xs-12 col-md-6">
						<h2>{{$residence->name}}</h2>
						<h3>{{$residence->street}}</h3>
						<h3>{{$residence->city}}</h3>
						<h4 class="capitalise">{{$residence->postcode}}</h4>
						@can('landlord_owner', $residence)
							<div class="no-padding col-xs-4 no-padding">
								<a href="{{route('residence.edit', ['id'=>$residence->id])}}">Edit Residence</a>
							</div>
						@endcan
					</div>
				{{-- END DETAILS --}}
					@include('residences.reviews')
					{{-- <div class="col-xs-12 col-md-6">	
						<div id="map"></div>
					</div> --}}

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1">
				@include('residences.add');
			</div>
		</div>

		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 review-box">
				
			</div>
		</div>


	@section('scripts')


	<script>
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
		</script>
		
	@endsection

	{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYYnhRa-OxUlNUTfDZbCTPxrUyMWCFo4A&callback=initMap"
  type="text/javascript"></script> --}}
	
@endsection

