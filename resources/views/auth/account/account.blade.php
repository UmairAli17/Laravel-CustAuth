@extends('layouts.app')

@section('content')
	<div class="row">
			<div class="col-xs-12 dash-cont">
					<a class="no-underline" href="#">
						<div class="col-xs-12 col-md-4">
							<div class="col-xs-12 account-link-box">
									<span class="glyphicon glyphicon-user dash-icon"></span>My Profile
							</div>
						</div>
					</a>
					<a class="no-underline" href="{{ url('user/security')}}">
							<div class="col-xs-12 col-md-4">
								<div class="col-xs-12 account-link-box">
									<span class="glyphicon glyphicon-cog dash-icon"></span>Account Settings
								</div>
							</div>
					</a>
					<a class="no-underline" href="{{ url('user/my_posts')}}">
							<div class="col-xs-12 col-md-4">
								<div class="col-xs-12 account-link-box">
									<span class="glyphicon glyphicon-floppy-disk dash-icon"></span>My Posts
								</div>
							</div>
					</a>
					<a class="no-underline" href="{{ route('posts.approved')}}">
						<div class="col-xs-12 col-md-4">
							<div class="col-xs-12 account-link-box">
								<span class="glyphicon glyphicon-ok-circle dash-icon"></span>Approved Posts
							</div>
						</div>
					</a>
					<a class="no-underline" href="{{ route('posts.rejected')}}">
						<div class="col-xs-12 col-md-4">
							<div class="col-xs-12 account-link-box">
								<span class="glyphicon glyphicon-ok-circle dash-icon"></span>Rejected Posts
							</div>
						</div>
					</a>
			</div>
		</ul>
	</div>
@endsection