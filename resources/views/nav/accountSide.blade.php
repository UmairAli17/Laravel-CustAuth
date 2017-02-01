<!--Side Bar-->
<div class="col-md-2 sideBar">
	<ul class="noBullets">
		@include('nav.adminNav')
        @include('nav.landNav')
        <hr>
		<li><a href="#">My Profile</a></li>
		<li><a href="{{ url('user/security')}}">Account Security</a></li>
		
        <hr>
		
        <li><a href="{{ url('user/my_posts')}}">My Posts</a></li>
		<li><a href="#">Approved Posts</a></li>
		<li><a href="#">Rejected Posts</a></li>
	</ul>
</div>