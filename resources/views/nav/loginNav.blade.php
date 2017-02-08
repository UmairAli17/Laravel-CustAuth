<ul class="nav navbar-nav">
    <li><a href="{{ route('home') }}">All Posts</a></li>
    <li><a href="{{ route('residences.all') }}"> All Residences </a></li>
</ul>
<ul class="nav navbar-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>

    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="{{ url('user/account') }}"><i class="fa fa-btn"></i>My Account</a>
            @can ('admin-dashboard') <a href="{{ url('/admin') }}"><i class="fa fa-btn"></i>Admin Dashboard</a> @endcan
            <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
        </li>
    </ul>
</ul>