@include('layouts.head')
<body id="app-layout">

    <nav class="navbar navbar-default navbar-static-top">
    
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Estate Agents Logo Here
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar 
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>-->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <!--Navbar for Access/ Adding Content-->
                        @include('nav.loginNav')
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="row">
        <!--<div class="col-md-8 col-md-offset-2">-->
                @include('flash::message')
            <div class="row">
                @yield('content')
            </div>
        <!--</div>-->
    </div>
    <!-- JavaScripts -->
    <script src="https://code.jquery.com/jquery.js" integrity="" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <!--Allows for Flash Overlays-->
    <script>
        $('#flash-overlay-modal').modal();
    </script>
    
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>

</body>
</html>
