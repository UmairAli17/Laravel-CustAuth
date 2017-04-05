<!--Side Bar-->
<div class="col-md-2 sideBar">
	<ul class="noBullets">
		@include('nav.adminNav')
		<li><a href="{{ url('user/security')}}">Account Settings</a></li>
		<li><a href="{{ url('user/my_posts')}}">My Reviews</a></li>
		
        <hr>
		
        <li><a href="{{ route('posts.approved')}}">Approved Reviews</a></li>
		<li><a href="{{ route('posts.rejected')}}">Rejected Reviews</a></li>
	</ul>
</div>