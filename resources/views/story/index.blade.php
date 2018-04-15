@extends('layout.index')
@section('title',$title)
@section('path',$path)
@section('content')
@foreach ($getStory as $story)
<script type="text/javascript">
	var id = '{{ Auth::id() }}';
	var server = '{{ url("/") }}';

	function getComment(idstory, stt) {
		var offset = $('#offset-comment').val();
		var limit = $('#limit-comment').val();
		if (stt == 'new') {
			var url_comment = '{{ url("/get/comment/") }}'+'/'+idstory+'/0/'+offset;
		} else {
			var url_comment = '{{ url("/get/comment/") }}'+'/'+idstory+'/'+offset+'/'+limit;
		}
		$.ajax({
			url: url_comment,
			dataType: 'json',
		})
		.done(function(data) {
			var dt = '';
			for (var i = 0; i < data.length; i++) {
				var server_foto = server+'/profile/thumbnails/'+data[i].foto;
				var server_user = server+'/user/'+data[i].id;
				if (data[i].id == id) {
					dt += '<div class="frame-comment comment-owner">\
								<div class="dt-1">\
									<a href="'+server_user+'" title="'+data[i].name+'">\
										<div class="foto" style="background-image: url('+server_foto+')"></div>\
									</a>\
								</div>\
								<div class="dt-2">\
									<div class="desk comment-owner-radius">\
										<div class="comment-main">\
											'+data[i].description+'\
										</div>\
									</div>\
									<div class="tgl">\
										<span>'+data[i].created+'</span>\
										<span class="fa fa-lg fa-circle"></span>\
										<span class="del pointer" onclick="opQuestion('+"'open'"+','+"'Delete this comment ?'"+','+"'deleteComment("+data[i].idcomment+")'"+')" title="Delete comment.">Delete</span>\
									</div>\
								</div>\
							</div>';
				} else {
					dt += '<div class="frame-comment comment-owner">\
								<div class="dt-1">\
									<a href="'+server_user+'" title="'+data[i].name+'">\
										<div class="foto" style="background-image: url('+server_foto+')"></div>\
									</a>\
								</div>\
								<div class="dt-2">\
									<div class="desk comment-owner-radius">\
										<div class="comment-main">\
											'+data[i].description+'\
										</div>\
									</div>\
									<div class="tgl">\
										<span>'+data[i].created+'</span>\
									</div>\
								</div>\
							</div>';
				}
			}
			if (stt === 'new') {
				$('#place-comment').html(dt);
			} else {
				$('#place-comment').append(dt);

				var ttl = (parseInt($('#offset-comment').val()) + 5);
				$('#offset-comment').val(ttl);
			}
			if (data.length >= limit) {
				$('#frame-more-comment').show();
			} else {
				$('#frame-more-comment').hide();
			}
		})
		.fail(function(data) {
			console.log(data.responseJSON);
		});
		
	}
	function deleteComment(idcomment) {
		$.ajax({
			url: '{{ url("/delete/comment") }}',
			type: 'post',
			data: {'idcomment': idcomment},
		})
		.done(function(data) {
			if (data === 'success') {
				getComment('{{ $story->idstory }}', 'new');
			} else {
				opAlert('open', 'Deletting comment failed.');
			}
		})
		.fail(function(data) {
			console.log(data.responseJSON);
		}).
		always(function() {
			opQuestion('hide');
		});
	}
	$(document).ready(function() {
		$('#offset-comment').val(0);
		$('#limit-comment').val(5);
		getComment('{{ $story->idstory }}', 'add');

		$('.frame-love, .frame-loves').on('click', function(event) {
			var val_love = $('#'+event.target.id+' #val-love').val();
			$.ajax({
				url: '{{ url("/loves/add") }}',
				type: 'post',
				data: {'idstory': '{{ $story->idstory }}', 'ttl-loves': val_love},
			})
			.done(function(data) {
				$('.ttl-loves').html(data);
			});
		});

		$('#comment-publish').submit(function(event) {
			var idstory = '{{ $story->idstory }}';
			var desc = $('#comment-description').text();
			if (desc === '') {
				$('#comment-description').focus();
			} else {
				$.ajax({
					url: '{{ url("/add/comment") }}',
					type: 'post',
					data: {
						'description': desc,
						'idstory': idstory
					},
				})
				.done(function(data) {
					if (data === 'failed') {
						opAlert('open', 'Sending comment failed.');
						$('#comment-description').focus();
					} else {
						$('#comment-description').text('');
						//refresh comment
						getComment('{{ $story->idstory }}', 'new');
					}
				})
				.fail(function(data) {
					console.log(data.responseJSON);
					opAlert('open', 'There is an error, please try again.');
				});
			}
		});

		$('#load-more-comment').on('click', function(event) {
			getComment('{{ $story->idstory }}', 'add');
		});
	});
</script>
<div class="place-story">
	<div class="main">
		<div class="place">
			<div class="frame-story" id="main-story">
				<div class="pos top">
					<div class="here-block">
						<div class="profile">
							<a href="{{ url('/user/'.$story->id) }}">
								<div class="foto" style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
							</a>
							<div class="info">
								<div class="name">
									<div class="pos-story">
										<a href="{{ url('/user/'.$story->id) }}">
											<div class="story-name">
												{{ $story->name }}
											</div>
										</a>
										<div class="date">
											<span class="ttl-views">{{ $story->visitor }} Visited</span>
											<span class="fa fa-lg fa-circle"></span>
											<span class="ttl-views">{{ $story->ttl_story }} Stories</span>
										</div>
									</div>
								</div>
							</div>
							<div class="tool">
								<button class="btn btn-circle btn-black2-color btn-active" onclick="opPostPopup('open', 'menu-popup', '{{ $story->idstory }}', '{{ $story->id }}', '{{ $title }}')">
									<span class="fa fa-lg fa-ellipsis-h"></span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="pos mid">
					<div class="ctn ctn-serif ctn-pad info-story">
						<h1 class="title"><?php echo $story->title; ?></h1>
						<div class="about">
							<span>{{ $story->views }} Views</span>
							<span class="fa fa-lg fa-circle"></span>
							<span><span class="ttl-loves">{{ $story->loves }}</span> Loves</span>
							<span class="fa fa-lg fa-circle"></span>
							<span><span class="ttl-loves">{{ $story->ttl_comment }}</span> Comments</span>
							<span class="fa fa-lg fa-circle"></span>
							<span>Published on {{ date('F d, Y h:i:sa', strtotime($story->created)) }}</span>
						</div>
					</div>
					<div>
						<div class="place-cover">
							<img src="{{ asset('/story/covers/'.$story->cover) }}" alt="">
						</div>
					</div>
					<div class="content ctn ctn-main ctn-sans-serif">
						<?php echo $story->description; ?>
					</div>
				</div>
				<div class="pos bot">
					<div class="here-block">
						@if (count($tags) > 0)
							<h3>Keyword</h3>
							@foreach($tags as $tag)
							<?php 
								$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
								$title = str_replace($replace, '', $tag->tag); 
							?>
							<a href="{{ url('/tags/'.$title) }}" class="frame-tag">
								<div>{{ $tag->tag }}</div>
							</a>
							@endforeach
						@endif
					</div>
					<div class="loved">
						<div>
							<h3>How much do you love it ?</h3>
						</div>
						<div>
							<h1>
								<span class="ttl-loves">{{ $story->loves }}</span>
								<span>Loves</span>
							</h1>
						</div>
					</div>
					<div class="loved here">
						<div class="here-block">
							<h3>Let's Share to your Friends</h3>
							<ul class="menu-share">
								<li class="mn btn-color-fb">
									<span class="fa fa-lg fa-facebook"></span>
									<span class="hdr">Share</span>
								</li>
								<li class="mn btn-color-tw">
									<span class="fa fa-lg fa-twitter"></span>
									<span class="hdr">Tweet</span>
								</li>
								<li class="mn btn-color-gg">
									<span class="fa fa-lg fa-pinterest"></span>
									<span class="hdr">Pinterest</span>
								</li>
								<li class="mn btn-color-gg">
									<span class="fa fa-lg fa-google-plus"></span>
									<span class="hdr">Google Plus</span>
								</li>
							</ul>
						</div>
					</div>
					<div class="loved other">
						<button class="story-love pos4-fixed love btn-color-ttl btn-transaparent">
							<span class="ttl-loves">{{ $story->loves }}</span>
						</button>
						<button class="story-love pos3-fixed love btn-color-gg-2 frame-loves" id="frame-love-1">
							<input type="hidden" name="love-1" disabled="true" id="val-love" value="1">
							<span class="fa fa-lg fa-thumbs-o-up"></span>
						</button>
						<button class="story-love pos2-fixed btn-primary-color btn-transaparent" onclick="addBookmark('{{ $story->idstory }}')">
							@if (is_int($check))
							<span class="fa fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
							@else
							<span class="fa fa-lg fa-bookmark-o" id="bookmark-{{ $story->idstory }}"></span>
							@endif
						</button>
					</div>
					<div class="loved top-comment">
						@if (Auth::id())
						<form method="post" action="javascript:void(0)" id="comment-publish">
							<div class="comment-head">
								<div class="cmt-1 edit-text txt-primary-color" id="comment-description" contenteditable="true"></div>
								<div class="cmt-2 place-btn">
									<button type="submit" name="btn-comment" class="btn btn-main-color">
										<span class="fa fa-lg fa-send"></span>
									</button>
								</div>
							</div>
						</form>
						@endif
						<div class="comment-content" id="place-comment"></div>
					</div>
					<div class="frame-more padding-bottom" id="frame-more-comment">
						<input type="hidden" name="offset" id="offset-comment" value="0">
						<input type="hidden" name="limit" id="limit-comment" value="0">
						<button class="btn btn-sekunder-color" id="load-more-comment">
							<span class="Load More Comment">Load More Comment</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endforeach
<div class="col-small">
	<div class="block">
		<div class="post-small">
			@foreach ($allStory as $story)
			@include('main.post')
			@endforeach
		</div>
	</div>
</div>
<div class="padding-bottom"></div>
@endsection
