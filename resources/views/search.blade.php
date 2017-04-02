	{!! Form::open(['method' => 'GET', 'route' => 'residences.all', 'class' => 'form-horizontal']) !!}
	
	    <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
	        {!! Form::text('q', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Search']) !!}
	        <small class="text-danger">{{ $errors->first('search') }}</small>
	    </div>
	
	{!! Form::close() !!}
