			{{-- START REVIEWS --}}
			<div class="col-xs-12 col-md-6 no-padding">
				<h1 >Reviews</h1>
				<div class="in-ratings-cont">
							<p style="font-size: 1.5em;">Care to leave a vote?</p>
							{!! Form::open(['route' => ['residence.upvote', $residence->id], 'method'=> 'POST']) !!}
								<button type="submit" class="btn btn-default post-up-btn" name="rating" id="rating"><span class="glyphicon glyphicon-arrow-up"></span></button>
							{!! FORM::close() !!}
							{!! Form::open(['route' => ['residence.downvote', $residence->id], 'method'=> 'POST']) !!}
								<button type="submit" class="btn btn-default post-up-btn" name="rating" id="rating"><span class="glyphicon glyphicon-arrow-down"></span></button>
							{!! FORM::close() !!}
						</div> 
				@forelse($residence->posts as $reviews)
						<div class="review-card">
								<h3>Review by:{{$reviews->user->name}}</h3>
								@for ($i=1; $i <= 5 ; $i++)
							      <span class="glyphicon glyphicon-star{{ ($i <= $reviews->rating) ? '' : '-empty'}}"></span>
							    @endfor
								<h4>{{$reviews->title}}</h4>
								<p class="review-card-text">{{$reviews->body}}</p>
								@can('owns_post', $reviews) <a href="{{ route('posts.edit', $reviews->id) }}">Edit</a>@endcan
								{!! Form::open(['route' => ['posts.upvote', $reviews->id], 'method'=> 'POST']) !!}
									<button type="submit" class="btn btn-default" name="post_rating" id="post_rating"><span class="glyphicon glyphicon-arrow-up"></span></button>
								{!! FORM::close() !!}
								{!! Form::open(['route' => ['posts.downvote', $reviews->id], 'method'=> 'POST']) !!}
									<button type="submit" class="btn btn-default" name="post_rating" id="post_rating"><span class="glyphicon glyphicon-arrow-down"></span></button>
								{!! FORM::close() !!}
								@can('landlord_owner', $residence)<button  class="btn btn-default reply_btn" >Reply</button>@endcan
								<div class="col-xs-12 reply_form no-padding">
										{!! Form::open(['route' => ['posts.reply', $reviews->id], 'method'=> 'POST']) !!}
											<div class="form-group">
												{!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
											</div>
											<div class="form-group">
												{!! Form::submit('Post Reply', ['class' => 'btn reply-btn']); !!}
											</div>
										{!! Form::close() !!}
								</div>
								@forelse($reviews->comments as $replies)
									<hr>
									<div class="reply-cont">
										<p class="landlord-tag">{{$replies->user->name}}</p>
										<p class="landlord-replies">{{$replies->comment}}</p>
										@can('can_reply', $replies)<a href="{{ route('comment.edit', $replies->id)}}"><div class="btn btn-default l-r-c">Edit Reply</div></a>@endcan
									</div>
								@empty
									<p>No replies form Landlord as of yet</p>
								@endforelse
							</div>
				@empty
					<div class="col-xs-12">
						<p>No Reviews for this Residence as of Yet!</p>
					</div>
			@endforelse