<div class="col-md-3">
	<div class="panel-body">
		<ul class="nav" role="tablist">
			<li role="presentation">
				<a href="{{ url('/home') }}">Dashboard</a>
			</li>		
		</ul>

		<ul class="nav" role="tablist">
			<li role="presentation">
				<a href="{{ url('/admin/role') }}">Role</a>
			</li>		
		</ul>

		<ul class="nav" role="tablist">
			<li role="presentation">
				<a href="{{ url('/admin/permission') }}">Permission</a>
			</li>		
		</ul>

		<ul class="nav" role="tablist">
			<li role="presentation">
				<a href="{{ url('/user') }}">User</a>
			</li>		
		</ul>

		<ul class="nav" role="tablist">
			<li role="presentation">
				<a href="{{url('movie/movie')}}">Movie</a>
			</li>		
		</ul>

		<ul class="nav" role="tablist">
			<li role="presentation">
				<a href="{{url('blog/blog')}}">Blog</a>
			</li>		
		</ul>
		
	</div>
</div>