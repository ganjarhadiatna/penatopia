@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$('#post-nav ol li').each(function(index, el) {
			$(this).removeClass('active');
			$('#{{ $nav }}').addClass('active');
		});
	});
</script>
<div class="col-small">
	<div class="frame-profile">
		@foreach ($profile as $p)
		<div class="cover" style="background-image: url({{ asset('/profile/photos/'.$p->foto) }});">
			<div class="place-cover"></div>
		</div>
		<div class="place-profile">
			<div class="profile">
				<div class="side-pp">
					<div class="foto" id="place-picture" style="background-image: url({{ asset('/profile/thumbnails/'.$p->foto) }});">
					</div>
				</div>
				<div class="main-pp">
					<div class="info">
						<h1 id="edit-name">{{ $p->name }}</h1>
					</div>
					<div class="menu-list">
						<ul>
							<li>
								<a href="{{ url('/user/'.$p->id) }}">
									<div class="val">{{ $p->visitor }}</div>
									<div class="ttl">Visited</div>
								</a>
							</li>
							<li>
								<a href="{{ url('/user/'.$p->id.'/story') }}">
									<div class="val">{{ $p->ttl_story }}</div>
									<div class="ttl">Stories</div>
								</a>
							</li>
							<li>
								<a href="{{ url('/user/'.$p->id.'/bookmark') }}">
									<div class="val">{{ $p->ttl_bookmark }}</div>
									<div class="ttl">Bookmarks</div>
								</a>
							</li>
							<li>
								<a href="{{ url('/user/'.$p->id.'/following') }}">
									<div class="val">{{ $p->ttl_following }}</div>
									<div class="ttl">Following</div>
								</a>
							</li>
							<li>
								<a href="{{ url('/user/'.$p->id.'/followers') }}">
									<div class="val">{{ $p->ttl_followers }}</div>
									<div class="ttl">Followers</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="tool-pp">
					<div class="info"></div>
					<div class="other">
						@if (Auth::id() == $p->id)
							<a href="{{ url('/me/setting') }}">
								<input type="button" name="edit" class="btn btn-main2-color" id="btn-edit-profile" value="Edit Profile">
							</a>
						@else
							@if (!is_int($statusFolow))
								<input type="button" name="edit" class="btn btn-main2-color" id="add-follow-{{ $p->id }}" value="Follow" onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
							@else
								<input type="button" name="edit" class="btn btn-main-color" id="add-follow-{{ $p->id }}" value="Unfollow" onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
							@endif
						@endif
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<div class="post-nav" id="post-nav">
		<ol>
			<a href="{{ url('/user/'.$p->id.'/story') }}"><li class="active" id="story">All Stories</li></a>
		    <a href="{{ url('/user/'.$p->id.'/bookmark') }}"><li id="bookmark">Bookmarks</li></a>
		</ol>
	</div>
	<div class="block pp-bot">
		<div class="post-small">
			<div class="user-info">
				<div class="head">
					<h3>About</h3>
				</div>
				<div class="other">
					<p class="about">{{ $p->about }}</p>
				</div>
			</div>
			<div class="user-info">
				<div class="head">
					<h3>Website</h3>
				</div>
				<div class="other">
					<a href="{{ $p->website }}" target="_blank">{{ $p->website }}</a>
				</div>
			</div>
			@foreach ($userStory as $story)
			@include('main.post')
			@endforeach
		</div>
	</div>
	{{ $userStory->links() }}
</div>
@endsection