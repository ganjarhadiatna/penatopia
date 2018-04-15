<div class="frame frame-post">
	<div class="main">
		<div class="main-mid">
			<div class="bot">
				<a href="{{ url('/user/'.$story->id) }}">
					<div class="foto" style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
				</a>
				<div class="info">
					<a href="{{ url('/user/'.$story->id) }}">
						<div class="name">{{ $story->name }}</div>
					</a>
				</div>
				<button class="love btn-circle btn-black2-color" onclick="opPostPopup('open', 'menu-popup', '{{ $story->idstory }}', '{{ $story->id }}', '{{ $title }}')">
					<span class="fa fa-lg fa-ellipsis-h"></span>
				</button>
			</div>
		</div>
		<?php 
			$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
			$title = str_replace($replace, '', $story->title); 
		?>
		<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
			<div class="top">
				<img src="{{ asset('/story/thumbnails/'.$story->cover) }}" alt="">
				@if ($story->tag)
					<?php 
						$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
						$title = str_replace($replace, '', $story->tag); 
					?>
					<a href="{{ url('/tags/'.$title) }}">
						<div class="tag btn-color-fb">
							{{ $story->tag }}
						</div>
					</a>
				@endif
			</div>
		</a>		
		<div class="main-mid">
			<div class="mid">
				<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
					<strong class="clr ttl-post">
						{{ $story->title }}
					</strong>
				</a>
			</div>
			<div class="date">
				<span class="ttl-views">{{ date('F d, Y', strtotime($story->created)) }}</span>
			</div>
		</div>
		<div class="mid">
			<div class="tool bdr-top">
				<ul>
					<li>
						<span class="icn fa fa-lg fa-align-left"></span>
						<span class="ttl-views">{{ $story->views }}</span>
					</li>
					<li>
						<span class="icn fa fa-lg fa-heart-o"></span>
						<span class="ttl-views">{{ $story->loves }}</span>
					</li>
					<li>
						<span class="icn fa fa-lg fa-comment-o"></span>
						<span class="ttl-views">{{ $story->ttl_comment }}</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>