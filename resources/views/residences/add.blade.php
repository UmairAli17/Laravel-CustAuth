<div class="col-xs-12 col-md-6 no-padding">
<h2>Would you like to leave a review?</h2>
{!! Form::open(['route' => ['residence.store_residence_review', $residence->id], 'method' => 'POST']) !!}			
	<div class="form-group">
		{!! Form::label('rating', 'Rate Residence:') !!}
		{!! Form::select('rating', [1,2,3,4,5], null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('title', 'Title:') !!}
		{!! Form::text('title', null, ['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('body', 'Main Text:') !!}
		{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
	</div>	

	<div class="form-group">
		{!! Form::submit('Submit Post', ['class' => 'add-review-btn']) !!}
	</div>
{!! Form::close() !!}
@include('errors.list')
</div>
