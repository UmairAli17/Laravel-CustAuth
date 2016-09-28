@extends('layouts.app')

@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="col-md-10 col-md-offset-1">

		<div class="panel-heading"><h2>{{$post->title}}</h2> @can('owns_post', $post) <a href="{{ route('posts.edit', $post->id) }}">Update Posts</a>@endcan</div>
		
		<div class="panel-body">
		<p>{{$post->body}}</p></div>

	</div>
</div>
@endsection
