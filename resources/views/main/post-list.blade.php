<div class="frame frame-post-list">
	<div class="main">
		<?php 
			$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
			$title = str_replace($replace, '', $story->title); 
		?>
		<div class="sd-right">
			<div class="mid">
				<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
					<h3 class="clr ttl-post">
						{{ $story->title }}
					</h3>
				</a>
				<div class="date">
					<span class="ttl-views">{{ $story->views }} Views</span>
					<span class="fa fa-lw fa-circle"></span>
					<span class="ttl-views">{{ $story->loves }} Loves</span>
					<span class="fa fa-lw fa-circle"></span>
					<span class="ttl-views">{{ $story->ttl_comment }} Comments</span>
				</div>
				<div class="date">
					<span class="ttl-views">{{ date('F d, Y h:i:sa', strtotime($story->created)) }}</span>
				</div>
			</div>
			<div class="bot">
				<a href="{{ url('/u/'.$story->id) }}">
					<div class="foto" style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
					<div class="info">
						<div class="name">{{ $story->name }}</div>
						<div class="date">
							<span class="ttl-views">{{ $story->visitor }} Visited</span>
							<span class="fa fa-lg fa-circle"></span>
							<span class="ttl-views">{{ $story->ttl_story }} Stories</span>
						</div>
					</div>
				</a>
				<button class="love btn-circle btn-black2-color" onclick="opPostPopup('open', 'menu-popup', '{{ $story->idstory }}', '{{ $story->id }}', '{{ $title }}')">
					<span class="fa fa-lg fa-ellipsis-h"></span>
				</button>
			</div>
		</div>
		<div class="sd-left">
			<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
				<div class="top" style="background-image: url({{ asset('/story/thumbnails/'.$story->cover) }})">
				</div>
			</a>
		</div>
	</div>
</div>