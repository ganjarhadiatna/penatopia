<script type="text/javascript">
	var iduser = '{{ Auth::id() }}';
	var server = '{{ url("/") }}';
	var off = 5;
	function getNotifStory(stt) {
		if (stt === 'new') {
			var limit = $('#offset-notif-story').val();
		} else {
			var limit = off;
		}
		var offset = $('#offset-notif-story').val();
		$.ajax({
			url: '{{ url("/notif/story") }}',
			type: 'post',
			data: {'limit': limit, 'offset': offset},
			dataType: 'json',
		})
		.done(function(data) {
			var dt = '';
			for (var i = 0; i < data.length; i++) {
				var server_foto = server+'/profile/thumbnails/'+data[i].foto;
				var server_cover = server+'/story/thumbnails/'+data[i].cover;
				var server_post = server+'/story/'+data[i].idstory;
				var server_user = server+'/user/'+data[i].id;
				dt += '\
					<div class="frame-notif">\
						<div class="notif-sid">\
							<div class="foto" style="background-image: url('+server_foto+');" onclick="toLink('+"'"+server_user+"'"+')"></div>\
						</div>\
						<div class="notif-mid">\
							<div class="desc">\
								<strong onclick="toLink('+"'"+server_user+"'"+')">'+data[i].name+'</strong> '+data[i].title+'\
							</div>\
							<div class="desc date">\
								'+data[i].created+'\
							</div>\
							<div class="foto" style="background-image: url('+server_cover+');" onclick="toLink('+"'"+server_post+"'"+')"></div>\
						</div>\
					</div>';
			}
			if (stt === 'new') {
				$('#val-storys').html(dt);
			} else {
				$('#val-storys').append(dt);
				var x = parseInt(off) + parseInt($('#offset-notif-story').val());
				$('#offset-notif-story').val(x);
			}
			if (data.length >= off) {
				$('#btn-story').show();
			} else {
				$('#btn-story').hide();
			}
		})
		.fail(function(data) {
			console.log(data.responseJSON);
		});
		
	}
	function getNotifFollowing(stt) {
		if (stt === 'new') {
			var limit = $('#offset-notif-following').val();
		} else {
			var limit = off;
		}
		var offset = $('#offset-notif-following').val();
		$.ajax({
			url: '{{ url("/notif/following") }}',
			type: 'post',
			data: {'limit': limit, 'offset': offset},
			dataType: 'json',
		})
		.done(function(data) {
			var dt = '';
			for (var i = 0; i < data.length; i++) {
				var server_foto = server+'/profile/thumbnails/'+data[i].foto;
				var server_user = server+'/user/'+data[i].id;
				dt += '\
					<div class="frame-notif">\
						<div class="notif-sid">\
							<div class="foto" style="background-image: url('+server_foto+');" onclick="toLink('+"'"+server_user+"'"+')"></div>\
						</div>\
						<div class="notif-mid">\
							<div class="desc">\
								<strong onclick="toLink('+"'"+server_user+"'"+')">'+data[i].name+'</strong> '+data[i].title+'\
							</div>\
							<div class="desc date">\
								'+data[i].created+'\
							</div>\
						</div>\
					</div>';
			}
			if (stt === 'new') {
				$('#val-following').html(dt);
			} else {
				$('#val-following').append(dt);
				var x = parseInt(off) + parseInt($('#offset-notif-following').val());
				$('#offset-notif-following').val(x);
			}

			if (data.length >= off) {
				$('#btn-following').show();
			} else {
				$('#btn-following').hide();
			}
		})
		.fail(function(data) {
			console.log(data.responseJSON);
		});
		
	}
	function cekNotif() {
		$.get('{{ url("/notif/cek") }}', function(data) {
			//console.log('notif: '+data);
			if (data != 0) {
				$('#main-notif-sign').show();
			} else {
				$('#main-notif-sign').hide();
			}
		});
	}
	function cekNotifStory() {
		$.get('{{ url("/notif/cek/story") }}', function(data) {
			if (data != 0) {
				$('#story-notif-sign').show();
			} else {
				$('#story-notif-sign').hide();
			}
		});
	}
	function cekNotifFollowing() {
		$.get('{{ url("/notif/cek/following") }}', function(data) {
			if (data != 0) {
				$('#following-notif-sign').show();
			} else {
				$('#following-notif-sign').hide();
			}
		});
	}
	$(document).on('click', function(event) {
		$('#op-notif').removeClass('active');
		$('#op-notif span').attr('class', 'fa fa-lg fa-bell-o');
		$('#notifications').hide();
	});
	$(document).ready(function() {
		$('#offset-notif-story').val(0);
		$('#offset-notif-following').val(0);
		$('#place-storys').show();
		//getNotifStory('none');

		if (iduser) {
			setInterval('cekNotif()', 3000);
		}
		

		$('#op-notif').on('click', function(event) {
			event.stopPropagation();
			$('#op-notif').addClass('active');
			$('#op-notif span').attr('class', 'fa fa-lg fa-bell');
			$('#notifications').show();
			cekNotifStory();
			cekNotifFollowing();
			getNotifStory('none');
		});

		$('#close-notif').on('click', function(event) {
			$('#op-notif').removeClass('active');
			$('#op-notif span').attr('class', 'fa fa-lg fa-bell-o');
			$('.notifications').hide();
		});

		$('#notifications, #notifications *').on('click', function(event) {
			return false;
		});

		$('#notif-nav ol li').on('click', function(event) {
			event.preventDefault();

			$('#notif-nav ol li').each(function(index, el) {
				$(this).removeClass('choose');
			});
			$(this).addClass('choose');
			$('.notifications .main .put .val').hide();

			var tr = $(this).attr('id');
			$('#place-'+tr).show();
			if (tr === 'storys') {
				if ($('#val-storys').html() == '') {
					getNotifStory('none');
				}
			} else {
				if ($('#val-following').html() == '') {
					getNotifFollowing('none');
				}
			}
		});
	});
</script>
<div class="notifications" id="notifications">
	<label class="sig fa fa-2x fa-caret-up"></label>
	<div class="main">
		<div class="pan">
			<h2>Notifications</h2>
			<button class="close btn btn-circle btn-black2-color" id="close-notif">
				<span class="fa fa-lg fa-close"></span>
			</button>
		</div>
		<div class="post-nav" id="notif-nav">
			<ol>
				<li id="following">
					Following
					<span class="notif-icn fa fa-lg fa-circle" id="following-notif-sign"></span>
				</li>
				<li class="choose" id="storys">
					Story
					<span class="notif-icn fa fa-lg fa-circle" id="story-notif-sign"></span>
				</li>
			</ol>
		</div>
		<div class="put">
			<div class="val" id="place-following">
				<input type="hidden" name="offset-notif-following" id="offset-notif-following" value="0">
				<div id="val-following"></div>
				<div class="load-other" id="btn-following">
					<input type="button" class="btn btn-grey-color" value="Load More" onclick="getNotifFollowing('none');">
				</div>
			</div>
			<div class="val" id="place-storys">
				<input type="hidden" name="offset-notif-story" id="offset-notif-story" value="0">
				<div id="val-storys"></div>
				<div class="load-other" id="btn-story">
					<input type="button" class="btn btn-grey-color" value="Load More" onclick="getNotifStory('none');">
				</div>
			</div>
		</div>
	</div>
</div>