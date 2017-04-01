<div class="row">
	<div class="col-md-8">
		{!! Form::open(['route' => 'posts.reply', $reviews->id]) !!}
			<div class="form-group">
				{!! Form::textarea('comment', null, , '3 < 4', ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Post Reply'); !!}
			</div>
		{!! Form::close() !!}
	</div>
</div>