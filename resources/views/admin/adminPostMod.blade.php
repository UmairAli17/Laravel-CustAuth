@extends('layouts.app')

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
				<div class="panel-heading">Latest Posts</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<th>Author</th>
								<th>Title</th>
								<th>Body</th>
								<th>Created At</th>
								<th>Approval Status</th>
								<td>Moderate</td>
							</thead>

							<tbody>
								@foreach ($post as $posts)
									<tr>
										
											<td>{{$posts->user->name}}</td>
											<td><a href="{{ url('/posts', $posts->id) }}">{{$posts->title}}</a></td>
											<td>{{$posts->body}}</td>
											<td>{{$posts->created_at}}</td>
											<td>{{$posts->approval}}</td>
											<td>
											{!! Form::model($posts, ['method' => 'PATCH', 'url' => 'mp/ap/' . $posts->id]) !!}
												{{ Form::button('<i class="glyphicon glyphicon-ok"', ['type'=>'submit', 'name' => 'approval', 'value' => 1]) }}
												<td>{{ Form::button('<i class="glyphicon glyphicon-remove"', ['type' => 'submit', 'name' => 'approval', 'value' => 3]) }}</td>
											{!! Form::close() !!}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>	
			</div>
		</div>
@endsection

