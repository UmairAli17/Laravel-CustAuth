@extends('layouts.app')


@section('content')
<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-default">
			<div class="panel-heading">My Rejected Posts</div>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<th>Title</th>
							<th>Main Text</th>
							<th>Created At</th>
							<th>Updated At</th>
						</thead>

						<tbody>
							@foreach ($posts as $post)
								<tr>
									<td>{{$post->title}}</td>
									<td>{{$post->body}}</td>
									<td>{{$post->created_at}}</td>
									<td>{{$post->updated_at}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
		</div>
</div>
@endsection