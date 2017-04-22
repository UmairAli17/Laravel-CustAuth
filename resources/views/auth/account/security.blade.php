@extends('layouts.app')

@section('content')
	@include('nav.accountSide')



	<div class="col-md-10">

		<div class="panel panel-default">
			<div class="panel-heading">Change Username</div>
			{!! Form::model($user, ['url' => '/user/security/change_name']) !!}
				<div class="form-group">
					{!! Form::label('name', 'Name:') !!}
					{!! Form::text('name', null, ['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Change Name', ['class' => 'btn btn-primary form-control']) !!}
				</div>
			{!! Form::close() !!}


		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Change Your Password</div>
				{{ Form::open(array('url' => '/user/security/change_password')) }}
					<div class="form-group">
						{!! Form::label('current_password', 'Enter Current Password:') !!}
						{!! Form::password('current_password', null, ['class'=>'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('password', 'Enter New Password:') !!}
						{!! Form::password('password', null, ['class'=>'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('password_confirmation', 'Confirm New Password:') !!}
						{!! Form::password('password_confirmation', null, ['class'=>'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Change Password', ['class' => 'btn btn-primary form-control']) !!}
					</div>					
				{!! Form::close() !!}

				@include('errors.list')
		</div>
	</div>
	
@endsection