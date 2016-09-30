@extends('layouts.app')

@section('content')
        @include('nav.accountSide')
        <div class="col-md-10 col-md-offset-1">
            <p>The below will be a foreach Loop of ALL posts. This is just a.. placeholder of sorts (y)</p>
            <div class="col-md-3" style="border:solid 1px;">
                <p>Content Here</p>
            </div>
            
            <div class="col-md-3" style="border:solid 1px;">
                <p>Content Here</p>
            </div>
            
            <div class="col-md-3" style="border:solid 1px;">
                <p>Content Here</p>
            </div>
            
            <div class="col-md-3" style="border:solid 1px;">
                <p>Content Here</p>
            </div>
        </div>
@endsection
