	{!! Form::open(['method' => 'GET', 'route' => 'residences.all', 'class' => 'form-horizontal']) !!}
	
	    <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
	    	<input type="text" class="form-control search" placeholder="Search" name="q" id="q"> 
	        <small class="text-danger">{{ $errors->first('search') }}</small>
	    </div>
	
	{!! Form::close() !!}


	
