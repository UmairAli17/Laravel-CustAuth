@extends('layouts.app')

@section('content')
        @include('nav.accountSide')
        <div class="col-md-10">
            <p>The below will be a foreach Loop of ALL posts. This is just a.. placeholder of sorts (y)</p>
            @foreach ($post as $posts)
            <div class="col-md-3" style="border:solid 1px;">
                <h3>{{$posts->title}}</h3>
                <p>{{$posts->body}}</p>
            </div>
            @endforeach
        </div>
@endsection
