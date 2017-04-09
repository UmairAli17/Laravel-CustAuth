@extends('layouts.full')

@section('content')
	<div class="col-xs-12 prof-top-bg">
		<a href="{{route('user.profile-edit', ['id' => $profile->profile->id])}}" class="col-md-2 edit-prof-btn pull-right no-underline">Edit Profile</a>
		<div class="container">
			<div class="row no-padding">
				<img class="img-responsive profile-img" src="{{  asset('/uploads/user/') . '/' . $profile->profile->image }}">
				<h1 class="prof-name">
					{{$profile->name}} 
					@if($profile->profile->gender === 'male')
						<sup><span class="ion-male prof-small-icon"></span></sup>
					@elseif($profile->profile->gender === 'female')
						<sup><span class="ion-female prof-small-icon"></sup>
					@elseif($profile->profile->gender === 'transgender')
						<sup><span class="ion-transgender prof-small-icon"></span></sup>
					@elseif($profile->profile->gender === 'N/A')
						<sup><p class="none-spec">None Specificied</p></sup>
					@endif
				</h1>
				<p class="prof-info">{{$profile->profile->occupation}}</p>
				<p class="prof-info">{{$profile->profile->education}}</p>
			</div>
		</div>
	</div>
	<div class="col-xs-12 prof-below">
		<div class="col-xs-12 col-md-4">
			<div class="prof-below-item">
				<div class="col-md-4 no-padding">
					<span class="ion-ios-chatboxes prof-icons"></span>
				</div>
				<div class="col-md-8 no-padding">
					<h3 class="prof-below-item-text">{{$total}}<br><span class="bold-emphasis">Total</span> <br>Reviews by {{$profile->name}}</h3>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-4">
			<div class="prof-below-item">
				<div class="col-md-4 no-padding">
					<span class="ion-ios-checkmark prof-icons"></span>
				</div>
				<div class="col-md-8 no-padding">
					<h3 class="prof-below-item-text">{{$approved}}<br><span class="bold-emphasis">Approved</span> <br>Reviews by {{$profile->name}}</h3>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-4">
			<div class="prof-below-item">
				<div class="col-md-4 no-padding">
					<span class="ion-ios-minus prof-icons"></span>
				</div>
				<div class="col-md-8 no-padding">
					<h3 class="prof-below-item-text">{{$rejected}}<br><span class="bold-emphasis">Rejected</span> <br>Reviews by {{$profile->name}}</h3>
				</div>
			</div>
		</div>
	</div>
@endsection