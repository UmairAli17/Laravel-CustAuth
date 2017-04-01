@extends('layouts.full')

@section('content')
	    <div class="col-xs-12 no-padding welcome-cont">
	    	<div class="col-xs-12 no-padding">
	        	<h1 class="welcome-header">RentSafe - <br><span class="welcome-header-small">Safe, Informative Renting</span></h1> 
		    </div>
	    </div>
	    <div class="container about">
	    	<h2 class="col-xs-12 about-head"> - What We're About - </h2>
	    	<h4 class="about-subhead">Providing a Platform for Student to Landlord Communication</h4>
	    	<p class="col-xs-6 col-xs-offset-3 about-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
	    
		    <div class="col-xs-12 no-padding">
		    	<div class="col-md-4 welcome-stat no-padding">
		    		<h2 class="welcome-stat-header">{{ $users }} <br><span class="welcome-stat-text">Users</span></h2>
		    	</div>

		    	<div class="col-md-4 welcome-stat no-padding">
		    		<h2 class="welcome-stat-header">{{ $residences }} <br><span class="welcome-stat-text">Residences</span></h2>
		    	</div>

		    	<div class="col-md-4 welcome-stat no-padding">
		    		<h2 class="welcome-stat-header">{{ $post }}<br><span class="welcome-stat-text"> Reviews</span></h2>
		    	</div>
	    	</div>
    	</div>

    	<a class="no-underline" href="{{url('/register')}}"><div class="home-signup-btn">Sign Up</div></a>
@endsection
