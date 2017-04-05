@include('layouts.head')
<body id="app-layout">

    @include('layouts.main-nav')
        <!--<div class="col-md-8 col-md-offset-2">-->
            <div class="row"><div class="col-sm-12 col-md-4 col-md-offset-4">@include('flash::message')</div></div>
                <div class="container">
                    @yield('content')
                </div>
        <!--</div>-->
    </script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    {{-- Global Scripts --}}
     <!-- JavaScripts -->
    <script src="https://code.jquery.com/jquery.js" integrity="" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
    <!--Allows for Flash Overlays-->
    <script>
        $('#flash-overlay-modal').modal();
    </script>
    
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>

    <script>
        @yield('scripts')

    </script>        

</body>
</html>
