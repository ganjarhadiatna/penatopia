@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-home">
	<div class="place-follow">
		<h1>{{ $ttl_following }} Following</h1>
		<div class="content-follow">
			@foreach ($profile as $p)
			<div class="frame-follow">
				<div class="top">
					<a href="{{ url('/user/'.$p->id) }}">
						<div class="foto" style="background-image: url({{ asset('/profile/photos/'.$p->foto) }});"></div>
					</a>
				</div>
				<div class="mid">
					{{ $p->name }}
				</div>
				@if ($p->id != Auth::id())
					<div class="bot">
						@if (is_int($p->is_following))
							<input type="button" name="follow" class="btn btn-main-color" id="add-follow-{{ $p->id }}" value="Unfollow" onclick="opFollow('{{ $p->id }}', '{{ url("/") }}')">
						@else
							<input type="button" name="follow" class="btn btn-grey-color" id="add-follow-{{ $p->id }}" value="Follow" onclick="opFollow('{{ $p->id }}', '{{ url("/") }}')">
						@endif
					</div>
				@endif
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection