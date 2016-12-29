<!--Only Admins can access the moderation links-->
    @can('moderate-users') <li><a href="{{ url('admin/moderate_users') }}">Moderate Users</a></li> @endcan
	@can('moderate-posts') <li><a href="{{ url('admin/moderate-posts') }}">Moderate Posts</a></li> @endcan