@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-home">
	<div class="ranking">
		<div class="side col-small">
			@include('ranking.menu')
		</div>
		<div class="main col-full">
			<div class="place-ctr">
				@foreach ($allTags as $tag)
				<?php 
					$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
					$title = str_replace($replace, '', $tag->tag); 
				?>
				<a href="{{ url('/tags/'.$title) }}">
					<div class="category" style="background-image: url({{ asset('img/cover.jpg') }})">
						<div class="cover">
						<h3>{{ $tag->tag }}</h3>
						</div>
					</div>
				</a>
				@endforeach 
			</div>
		</div>
	</div>
</div>
@endsection