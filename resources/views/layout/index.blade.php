<!DOCTYPE html>
<html>
<head>
	<title>Penatopia - @yield('title')</title>
	<meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ICON -->
    <link href="{{ asset('img/P/3.png') }}" rel='SHORTCUT ICON'/>

    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/css/font-awesome.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/assets.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/story.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/create.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/sign.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/notifications.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/ranking.css') }}">

	<!-- JS -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/follow.js') }}"></script>
	<script type="text/javascript">
		var iduser = '{{ Auth::id() }}';
		window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
		function setScroll(stt) {
			if (stt === 'hide') {
				$('html').addClass('set-scroll');
			} else {
				$('html').removeClass('set-scroll');
			}
		}
		function opSearch(stt) {
			if (stt === 'open') {
				$('#search').fadeIn();
				$('#txt-search').select();
				setScroll('hide');
			} else {
				$('#search').fadeOut();
				setScroll('show');
			}
		}
		function opCreateStory(stt) {
			if (stt === 'open') {
				$('#create').fadeIn();
				setScroll('hide');
			} else {
				$('#create').fadeOut();
				setScroll('show');
			}
		}
		function opToggle(stt) {
			var tr = $('#'+stt).attr('class');
			if (tr === 'toggle fa fa-lg fa-toggle-off') {
				$('#'+stt).attr('class', 'toggle tgl-active fa fa-lg fa-toggle-on');
			} else {
				$('#'+stt).attr('class', 'toggle fa fa-lg fa-toggle-off');
			}
		}
		function addBookmark(idstory) {
			if (iduser === '') {
				opAlert('open', 'Please login berfore you can save this story.');
			} else {
				$.ajax({
					url: '{{ url("/add/bookmark") }}',
					type: 'post',
					data: {'idstory': idstory},
				})
				.done(function(data) {
					if (data === 'bookmark') {
						opAlert('open', 'Story has been saved to bookmark.');
						$('#bookmark-'+idstory).attr('class', 'fa fa-lg fa-bookmark');
					} else if (data === 'unbookmark') {
						opAlert('open', 'Story removed from bookmark.');
						$('#bookmark-'+idstory).attr('class', 'fa fa-lg fa-bookmark-o');
					} else if (data === 'failedadd') {
						opAlert('open', 'Failed to save story to bookmark.');
						$('#bookmark-'+idstory).attr('class', 'fa fa-lg fa-bookmark-o');
					} else if (data === 'failedremove') {
						opAlert('open', 'Failed to remove story from bookmark.');
						$('#bookmark-'+idstory).attr('class', 'fa fa-lg fa-bookmark');
					} else {
						opAlert('open', 'There is an error, please try again.');
					}
				})
				.fail(function(data) {
					//console.log(data.responseJSON);
					opAlert('open', 'There is an error, please try again.');
				});
			}
		}
		function toLink(path) {
			window.location = path;
		}
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$(document).ready(function() {
			var pth = "@yield('path')";
			$('#main-menu a li').each(function(index, el) {
				$(this).removeClass('active');
				$('#'+pth).addClass('active');
			});
			$('#place-search').submit(function(event) {
				var ctr = $('#txt-search').val();
				window.location = "{{ url('/search/') }}"+'/'+ctr;
			});
		});
	</script>
</head>
<body>
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>
	<div id="header">
		<div class="place">
			<div class="menu col-full">
				<div class="pos mid grid-1">
					<ul id="main-menu">
						<a href="{{ url('/') }}">
							<li id="home">
								<span class="icn fa fa-lg fa-home"></span>
								<span class="ttl">Home</span>
							</li>
						</a>
						<a href="{{ url('/collections') }}">
							<li id="collections">
								<span class="icn fa fa-lg fa-star"></span>
								<span class="ttl">Collections</span>
							</li>
						</a>
						<a href="{{ url('/ranking') }}">
							<li id="ranking">
								<span class="icn fa fa-lg fa-trophy"></span>
								<span class="ttl">Ranking</span>
							</li>
						</a>
					</ul>
				</div>
				<div class="pos lef grid-2">
					<div class="logo">
						<a href="{{ url('/') }}">
							<img src="{{ asset('/img/2.png') }}" alt="Mading.">
						</a>
					</div>
				</div>
				<div class="pos rig grid-3">
					<button class="btn btn-circle btn-black-color" onclick="opSearch('open')" id="home-search">
						<span class="icn fa fa-lg fa-search"></span>
					</button>
					@if (is_null(Auth::id()))
						<a href="{{ url('/login') }}">
							<button class="btn btn-circle btn-black-color" id="profile">
								<span class="icn fa fa-lg fa-sign-in"></span>
							</button>
						</a>
					@endif
					@if (Auth::id())
						<button class="btn btn-circle btn-black-color" id="op-notif">
							<div class="notif-icn absolute fa fa-lg fa-circle" id="main-notif-sign"></div>
							<span class="icn fa fa-lg fa-bell-o"></span>
						</button>
						@include('main.notifications')
						<a href="{{ url('/user/'.Auth::id()) }}">
							<button class="btn btn-circle btn-black-color" id="profile">
								<span class="icn fa fa-lg fa-user-o"></span>
							</button>
						</a>
					@endif
					<a href="{{ url('/compose') }}">
						<button class="create btn btn-color-gg" id="compose">
							<span class="icn fa fa-lg fa-plus-circle"></span>
							<span class="ttl-post">Create Story</span>
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div id="body" class="col-full">
		@yield("content")
	</div>
	<div id="footer">
		<div class="footer-place col-full">
			<div class="fo-pos fo-lef">
				<h3>Who are We ?</h3>
				<p>
				Penatopia is a blog site for people whos want to be a different. This site is not social media, this is micro bloging site that let you more actractive, creatif and make your brain will be more used.</p>
			</div>
			<div class="fo-pos fo-mid">
				<h3>Find Us</h3>
				<ul>
					<a href="#">
						<li>
							<span class="fa fa-lg fa-facebook"></span>
						</li>
					</a>
					<a href="#">
						<li>
							<span class="fa fa-lg fa-instagram"></span>
						</li>
					</a>
					<a href="#">
						<li>
							<span class="fa fa-lg fa-google-plus"></span>
						</li>
					</a>
					<a href="#">
						<li>
							<span class="fa fa-lg fa-pinterest"></span>
						</li>
					</a>
					<a href="#">
						<li>
							<span class="fa fa-lg fa-twitter"></span>
						</li>
					</a>
				</ul>
			</div>
			<div class="fo-pos fo-rig">
				<h3>Others</h3>
				<ul>
					<a href="#">
						<li>Home</li>
					</a>
					<a href="#">
						<li>About Us</li>
					</a>
					<a href="#">
						<li>Terms & Privace</li>
					</a>
					<a href="#">
						<li>Policy</li>
					</a>
					@if (is_null(Auth::id()))
						<a href="{{ route('login') }}">
							<li>Login</li>
						</a>
					@endif
					@if (Auth::id())
						<a href="{{ route('logout') }}" 
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							<li>Logout</li>
						</a>
					@endif
				</ul>
			</div>
		</div>
	</div>

	@include('main.loading-bar')
	@include('main.search')
	@include('main.post-menu')
	@include('main.question-menu')
	@include('main.alert-menu')

</body>
</html>
