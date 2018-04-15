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
			<div class="post">
				@foreach ($topStory as $story)
				<a href="#">
					@include('main.post')
				</a>
				@endforeach
			</div>
			{{ $topStory->links() }}
		</div>
	</div>
</div>
@endsection