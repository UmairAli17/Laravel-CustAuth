<div class="row">
	<div class="col-xs-12">
		{!! Form::open(['route' => 'posts.reply', $reviews->id]) !!}
			<div class="form-group">
				{!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Post Reply'); !!}
			</div>
		{!! Form::close() !!}
	</div>
</div>