@extends('layouts.full')

@section('content')
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 resi-img-cont"><img class="img-responsive resi-image" src="{{  asset('/uploads') . '/' . $residence->image }}"></div>
			<div class="col-xs-10 col-xs-offset-1">
				<h2>{{$residence->name}}</h2>
				<h3>{{$residence->street}}</h3>
				<h3>{{$residence->city}}</h3>
				<h4>{{$residence->postcode}}</h4>
				@can('landlord_owner', $residence)
				<div class="col-xs-4 pull-right">
					<a href="{{route('residence.edit', ['id'=>$residence->id])}}">Edit Residence</a>
				</div>
			@endcan
			</div>
		</div>
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1">
				@include('residences.add');
			</div>
		</div>

		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 review-box">
				<h1 style="margin-left: .35em">Reviews</h1>

				@forelse($residence->posts as $reviews)
						<div class="col-xs-12 col-md-6">
						<div class="review-card">
								<h3>Review by:{{$reviews->user->name}}</h3>
								@for ($i=1; $i <= 5 ; $i++)
							      <span class="glyphicon glyphicon-star{{ ($i <= $reviews->rating) ? '' : '-empty'}}"></span>
							    @endfor
								<h4>{{$reviews->title}}</h4>
								<p class="review-card-text">{{$reviews->body}}</p>
								@can('owns_post', $reviews) <a href="{{ route('posts.edit', $reviews->id) }}">Edit</a>@endcan
								{!! Form::open(['route' => ['posts.upvote', $reviews->id], 'method'=> 'POST']) !!}
									<button type="submit" name="post_rating" id="post_rating"><span class="glyphicon glyphicon-arrow-up"></span></button>
								{!! FORM::close() !!}
								{!! Form::open(['route' => ['posts.downvote', $reviews->id], 'method'=> 'POST']) !!}
									<button type="submit" name="post_rating" id="post_rating"><span class="glyphicon glyphicon-arrow-down"></span></button>
								{!! FORM::close() !!}
								@can('landlord_owner', $residence)<button class="reply_btn" >Reply</button>@endcan
								<div class="col-xs-12 reply_form">
									<div class="col-md-4">
										{!! Form::open(['route' => ['posts.reply', $reviews->id], 'method'=> 'POST']) !!}
											<div class="form-group">
												{!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
											</div>
											<div class="form-group">
												{!! Form::submit('Post Reply'); !!}
											</div>
										{!! Form::close() !!}
									</div>
								</div>
								@forelse($reviews->comments as $replies)
									<hr>
									<div class="reply-cont">
										<p class="landlord-tag">{{$replies->user->name}}</p>
										<p class="landlord-replies">{{$replies->comment}}</p>
										@can('can_reply', $replies)<a href="{{ route('comment.edit', $replies->id)}}">Edit Reply</a>@endcan
									</div>
								@empty
									<p>No replies form Landlord as of yet</p>
								@endforelse
							</div>
						</div>
				@empty
					<div class="col-xs-12">
						<p>No Reviews for this Residence as of Yet!</p>
					</div>
			@endforelse
			</div>
		</div>
	
	<script type="text/javascript">
		var initMap = function()
		{
			/*
				Set the event coordinates (lat, lng) to an object: event_coords
			 */
			var res_coords = {!! $postcode !!};
			navigator.geolocation.getCurrentPosition(function (position) { 
	        
			    var lat = position.coords.latitude;                    
			    var long = position.coords.longitude;                 
			    var coords = new google.maps.LatLng(lat, long);

			    var directionsService = new google.maps.DirectionsService();
			    var directionsDisplay = new google.maps.DirectionsRenderer();
			  
			    var map = new google.maps.Map($("#map")[0], {
		          zoom: 15,
		          center: coords
		        });
		  
	  
		     	directionsDisplay.setMap(map);
			    var request = {
			       origin:coords, 
			       destination: res_coords,
			       travelMode: google.maps.TravelMode.DRIVING,
			     };

			    directionsService.route(request, function (response, status) {
			       if (status == google.maps.DirectionsStatus.OK) {
			        	directionsDisplay.setDirections(response);
			    	}
			    });         
			});


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
		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYYnhRa-OxUlNUTfDZbCTPxrUyMWCFo4A&callback=initMap"
  type="text/javascript" async defer></script>
@endsection

