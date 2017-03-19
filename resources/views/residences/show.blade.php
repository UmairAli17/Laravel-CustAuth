@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="col-md-6">
			<h2>{{$residence->name}}</h2>
			<h3>{{$residence->street}}</h3>
			<h3>{{$residence->city}}</h3>
			</div>
			@can('landlord_owner', $residence)
			<div class="col-md-2">
				<a href="{{route('residence.edit', ['id'=>$residence->id])}}">Edit Residence</a>
			</div>
			@endcan
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Reviews</h1>
			@forelse($residence->posts as $reviews)
				<div class="col-md-12">
					<h3>Review by:{{$reviews->user->name}}
					<h4>{{$reviews->title}}</h4>
					@can('owns_post', $reviews) <a href="{{ route('posts.edit', $reviews->id) }}">Edit</a>@endcan
					@can('landlord_owner', $residence)<button class="reply_btn" >Reply</button>@endcan
					<div class="col-md-4 reply_form">
						<div class="row">
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
					</div>
						@forelse($reviews->comments as $replies)
							<p>{{$replies->comment}}</p>
							@can('can_reply', $replies)<div class="col-sm-12"><a href="{{ route('comment.edit', $replies->id)}}">Edit Reply</a></div>@endcan
						@empty
							<p>No replies form Landlord as of yet</p>
						@endforelse

						
				</div>
			@empty
				<p>No Reviews for this Residence as of Yet!</p>
			@endforelse
		</div>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<h2>Would you like to leave a review?</h2>
		<div class="panel-heading">
			{!! Form::open(['route' => ['residence.store_residence_review', $residence->id], 'method' => 'POST']) !!}			
				<div class="form-group">
					{!! Form::label('title', 'Title:') !!}
					{!! Form::text('title', null, ['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('body', 'Main Text:') !!}
					{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
				</div>	

				<div class="form-group">
					{!! Form::submit('Submit Post', ['class' => 'btn btn-primary form-control']) !!}
				</div>
			{!! Form::close() !!}
			@include('errors.list')
		</div>
	</div>
@endsection

