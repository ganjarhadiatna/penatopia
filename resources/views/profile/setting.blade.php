@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-home frame-edit">
	<div class="compose" id="create">
		<div class="main">
			<div class="create-head">
				<h3>Profile Setting</h3>
			</div>
			<div class="edit-body">
				<div class="edit-block">
					<p>Account</p>
					<ul>
						<a href="{{ url('/me/setting/profile') }}">
						    <li>
						    	<span class="ed-1">
						    		Edit Profile
						    	</span>
						    	<span class="ed-2">
						    		<span class="fa fa-lg fa-caret-right"></span>
						    	</span>
						    </li>
					    </a>
					    <a href="{{ url('/me/setting/password') }}">
						    <li>
						    	<span class="ed-1">
						    		Change Password
						    	</span>
						    	<span class="ed-2">
						    		<span class="fa fa-lg fa-caret-right"></span>
						    	</span>
						    </li>
						</a>
					    <li>
					    	<span class="ed-1">
					    		Timelines
					    	</span>
					    	<span class="ed-2">
					    		<span class="fa fa-lg fa-clock-o"></span>
					    	</span>
					    </li>
					</ul>
				</div>
				<div class="edit-block">
					<p>Others</p>
					<ul>
					    <li>
					    	<span class="ed-1">
					    		Delete this Account
					    	</span>
					    	<span class="ed-2">
					    		<span class="fa fa-lg fa-trash-o"></span>
					    	</span>
					    </li>
					    <li>
					    	<span class="ed-1">
					    		Logout
					    	</span>
					    	<span class="ed-2">
					    		<span class="fa fa-lg fa-power-off"></span>
					    	</span>
					    </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection