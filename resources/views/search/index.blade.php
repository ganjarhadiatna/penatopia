@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-home">
	<div class="search-people">
		<div class="display-mobile">
			@foreach ($topUsers as $usr)
			<div class="frame-user">
				<a href="{{ url('/user/'.$usr->id) }}">
					<div class="top" style="background-image: url({{ asset('/profile/thumbnails/'.$usr->foto) }});"></div>
				</a>
				<div class="mid">
					{{ $usr->name }}
				</div>
				<div class="bot">
					@if ($usr->id != Auth::id())
						@if (is_int($usr->is_following))
							<input type="button" name="follow" class="btn btn-main-color" id="add-follow-{{ $usr->id }}" value="Unfollow" onclick="opFollow('{{ $usr->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
						@else
							<input type="button" name="follow" class="btn btn-grey-color" id="add-follow-{{ $usr->id }}" value="Follow" onclick="opFollow('{{ $usr->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
						@endif
					@endif
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="search-tag">
		@foreach ($topTags as $tag)
		<?php 
			$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
			$title = str_replace($replace, '', $tag->tag); 
		?>
		<a href="{{ url('/tags/'.$title) }}">
			<div class="frame-tag">
				<div class="cover">
					<p>{{ $tag->tag }}</p>
				</div>
			</div>
		</a>
		@endforeach 
	</div>
	<div class="post">
		@foreach ($topStory as $story)
		@include('main.post')
		@endforeach
	</div>
	{{ $topStory->links() }}
</div>
@endsection