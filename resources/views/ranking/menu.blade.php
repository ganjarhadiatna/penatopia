<script type="text/javascript">
	$(document).ready(function() {
		var pth = "{{ $path_r }}";
		$('#nav-ranking ul a li').each(function(index, el) {
			$(this).removeClass('choose');
			$('#'+pth).addClass('choose');
		});
	});
</script>
<div class="navigator nav-theme-1 nav-2x" id="nav-ranking">
	<ul>
		<a href="{{ url('/ranking/user') }}"><li id="user">Users</li></a>
		<a href="{{ url('/ranking/story') }}"><li id="story">Stories</li></a>
	</ul>
</div>