	{!! Form::open(['method' => 'GET', 'route' => 'residences.all', 'class' => 'form-horizontal']) !!}
	
	    <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
	    	<div class="form-group{{ $errors->has('q') ? ' has-error' : '' }}">
	    	    {!! Form::text('q', null, ['class' => 'form-control', 'placeholder' => 'Search by Name, Postcode, Landlord', 'id'=>'q', 'required' => 'required']) !!}
	    	    <small class="text-danger">{{ $errors->first('q') }}</small>
	    	</div>
	    </div>
	
	{!! Form::close() !!}


	
