@extends('layouts.app')

@section('content')
        @include('nav.accountSide')
        <div class="col-md-10">
            @foreach ($post as $posts)
            <div class="col-md-3" style="border:solid 1px;">
                <div class="thumbnail">
                    <img src="#"/>
                </div>
                <h3>{{ $posts->title }}</h3>
                <p>{{ str_limit($posts->body, 150, '..') }}</p>
                @can('owns_post', $posts) <a href="{{ route('posts.edit', $posts->id) }}">Update Posts</a>@endcan</div>
            </div>
            @endforeach
        </div>
@endsection
