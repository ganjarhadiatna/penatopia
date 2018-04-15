@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-home">
	<div class="post">
		@foreach ($topStory as $story)
		<a href="#">
			@include('main.post')
		</a>
		@endforeach
	</div>
	{{ $topStory->links() }}
</div>
@endsection