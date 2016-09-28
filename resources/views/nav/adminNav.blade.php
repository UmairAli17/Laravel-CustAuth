<!--Only Admins can access the moderation links-->
    @can('moderate-users') <li><a href="{{ url('admins/moderate_users') }}">Moderate Users</a></li> @endcan
	@can('moderate-posts') <li><a href="{{ url('admins/moderate_posts') }}">Moderate Posts</a></li> @endcan
