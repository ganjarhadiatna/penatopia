@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-home">
	<div class="block">
		<h3 class="ctn-sekunder-color pad-2-10px">Top Collections</h3>
		<div class="place-ctr">
		@foreach ($topTags as $tag)
			<?php 
				$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
				$title = str_replace($replace, '', $tag->tag); 
			?>
			<a href="{{ url('/tags/'.$title) }}">
				<div class="category">
					<div class="cover">
					<h3>{{ $tag->tag }}</h3>
					</div>
				</div>
			</a>
		@endforeach 
		</div>
	</div>
	<div class="block">
		<h3 class="ctn-sekunder-color pad-2-10px">All Collections</h3>
		<div class="place-ctr">
		@foreach ($allTags as $tag)
			<?php 
				$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
				$title = str_replace($replace, '', $tag->tag); 
			?>
			<a href="{{ url('/tags/'.$title) }}">
				<div class="category">
					<div class="cover">
					<h3>{{ $tag->tag }}</h3>
					</div>
				</div>
			</a>
		@endforeach 
		</div>
	</div>
</div>
@endsection