@extends('layouts.full')

@section('content')
	<div class="col-xs-12 prof-top-bg">
		
			<div class="container-fluid">
					<div class="row no-padding">
						<img class="img-responsive business-img col-xs-12 col-md-4" src="{{  asset('/uploads/logos/') . '/' . $business->logoFileName }}">
						<div class="business-details col-xs-10 col-xs-offset-1 col-md-4">
								<h1 class="business-name">- {{$business->name}} -</h1>
								<p class="business-description">{{$business->description}}</p>
								<p class="business-contact">Contact Details:<br><span class="ion-android-call"></span> {{$business->phone}}<br><span class="ion-ios-navigate"></span> {{$business->address}}</p>

						</div>
						@can('business_owner', $business)
							<a href="{{route('business.edit', ['id' => $business->id])}}" class="col-md-4 edit-prof-btn no-underline">Edit Business Details</a>
						@endcan
						
					</div>
			</div>
	</div>
	<div class="col-xs-12 prof-below">
		<div class="col-xs-12 col-md-6">
			<div class="prof-below-item">
				<div class="col-md-4 no-padding">
					<span class="ion-ios-chatboxes prof-icons"></span>
				</div>
				<div class="col-md-8 no-padding">
					<h3 class="prof-below-item-text">Times Reviewed:<br><span class="bold-emphasis">{{$reviews}}</span></h3>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="prof-below-item">
				<div class="col-md-4 no-padding">
					<span class="ion-ios-checkmark prof-icons"></span>
				</div>
				<div class="col-md-8 no-padding">
						<h3 class="prof-below-item-text">{{$properties}}<br><span class="bold-emphasis">Total</span> Properties</h3>
				</div>
			</div>
		</div>
	</div>
@endsection