@extends('layouts.app')

@section('content')
	<div class="col-md-8 ">
		<h1>Welcome {{ Auth::user()->name }} </h1>
		<div class="panel panel-default">
			<div class="panel-heading">Latest Users</div>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<th>Name</th>
							<th>Email</th>
							<th>Created At</th>
						</thead>

						<tbody>
							@foreach ($user as $users)
								<tr>
									<td>{{$users->name}}</td>
									<td>{{$users->email}}</td>
									<td>{{$users->created_at}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
		</div>
		<hr>
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
						</thead>

						<tbody>
							@foreach ($post as $posts)
								<tr>
									<td>{{$posts->user->name}}</td>
									<td><a href="{{ url('/posts', $posts->id) }}">{{$posts->title}}</a></td>
									<td>{{$posts->body}}</td>
									<td>{{$posts->created_at}}</td>
									<td>{{$posts->approval}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>	
		</div>
	</div>
	<div class="col-md-4 mod-menu-cont">
		<h3>Moderation Menu</h3>
		<a href="{{route('admin.moderate')}}">Moderate Posts</a>
	</div>
@endsection