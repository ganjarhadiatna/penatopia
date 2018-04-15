@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	var server = '{{ url("/") }}';
	function opDialog(stt, path='') {
		if (stt === 'open') {
			$('#'+path).fadeIn();
		} else {
			$('.compose .create-dialog').fadeOut();
		}
	}
	function removeCover() {
		$("#image-preview").attr('src','');
		$('.compose .main .create-body .create-block .cover-icon .img').hide();
		$('.compose .main .create-body .create-block .cover-icon .icn').show();
	}
	function loadCover() {
		var OFReader = new FileReader();
		OFReader.readAsDataURL(document.getElementById("cover").files[0]);
		OFReader.onload = function (oFREvent) {
			$("#image-preview").attr('src', oFREvent.target.result);
		}
		$('.compose .main .create-body .create-block .cover-icon .img').show();
		$('.compose .main .create-body .create-block .cover-icon .icn').hide();
	}
	function putToText(html) {
		document.getElementById('write-story').focus();
	    var sel, range;
	    if (window.getSelection) {
	        // IE9 and non-IE
	        sel = window.getSelection();
	        if (sel.getRangeAt && sel.rangeCount) {
	            range = sel.getRangeAt(0);
	            range.deleteContents();

	            // Range.createContextualFragment() would be useful here but is
	            // non-standard and not supported in all browsers (IE9, for one)
	            var el = document.createElement("div");
	            el.innerHTML = html;
	            var frag = document.createDocumentFragment(), node, lastNode;
	            while ( (node = el.firstChild) ) {
	                lastNode = frag.appendChild(node);
	            }
	            range.insertNode(frag);
	            
	            // Preserve the selection
	            if (lastNode) {
	                range = range.cloneRange();
	                range.setStartAfter(lastNode);
	                range.collapse(true);
	                sel.removeAllRanges();
	                sel.addRange(range);
	            }
	        }
	    } else if (document.selection && document.selection.type != "Control") {
	        // IE < 9
	        document.selection.createRange().pasteHTML(html);
	    }
	}
	function getImage() {
		var fd = new FormData();
		var image = $('#get-image')[0].files[0];
		
		fd.append('image', image);
		$.each($('#form-image').serializeArray(), function(a, b) {
	    	fd.append(b.name, b.value);
	    });
	    $.ajax({
	    	url: '{{ url("/story/image/upload") }}',
			data: fd,
			processData: false,
			contentType: false,
			type: 'post',
			beforeSend: function() {
				$('#progressbar').show();
			}
	    })
	    .done(function(data) {
	    	var dt = '<img src="'+server+'/story/images/'+data+'" alt="image">';
	    	$('#progressbar').hide();
	    	$('#get-image').val('');
	    	putToText(dt);
	    })
	    .fail(function() {
	    	opAlert('open', 'We can not upload your Picture, please try again.');
	    	$('#progressbar').hide();
	    });
	}
	function getImageUrl() {
		var url = $('#image-url').val();
		if (url === '') {
			$('#image-url').focus();
		} else {
			var dt = '<img src="'+url+'" alt="image">';
			putToText(dt);
			opDialog('hide');
			$('#image-url').val('');
		}
	}
	function getLinkUrl() {
		var url = $('#link-url').val();
		if (url === '') {
			$('#link-url').focus();
		} else {
			var dt = '<a href="'+url+'" class="link">'+url+'</a>';
			putToText(dt);
			opDialog('hide');
			$('#link-url').val('');
		}
	}
	function getEmbed() {
		var url = $('#embed-code').val();
		if (url === '') {
			$('#embed-code').focus();
		} else {
			putToText(url);
			opDialog('hide');
			$('#embed-code').val('');
		}
	}
	function publish() {
		var fd = new FormData();
		var cover = $('#cover')[0].files[0];
		var title = $('#title-story').val();
		var content = $('#write-story').html();
		var tags = $('#tags-story').val();

		fd.append('cover', cover);
		fd.append('title', title);
		fd.append('content', content);
		fd.append('tags', tags);
		$.each($('#form-publish').serializeArray(), function(a, b) {
		   	fd.append(b.name, b.value);
		});

		$.ajax({
		  	url: '{{ url("/story/publish") }}',
			data: fd,
			processData: false,
			contentType: false,
			type: 'post',
			beforeSend: function() {
				open_progress('Uploading your Story...');
			}
		})
		.done(function(data) {
		   	if (data === 'failed') {
		   		opAlert('open', 'failed to publish story.');
		   		close_progress();
		   	} else {
		   		var cover = $('#cover').val('');
				var title = $('#title-story').val('');
				var content = $('#write-story').html('');
				opCreateStory('close');
				close_progress();
				window.location = '{{ url("/story/") }}'+'/'+data;
		   	}
		   	//console.log(data);
		})
		.fail(function() {
		  	opAlert('open', "there is an error, please try again.");
		   	close_progress();
		});

		return false;
	}
	$(document).ready(function() {
		$('#progressbar').progressbar({
			value: false,
		});
		$('#write-story').keyup(function(event) {
			/* Act on the event */
			var code = event.keyCode;
			var length = $(this).html().length;
			if (code === 13) {
				var dt = '<div class="ctn ctn-main ctn-serif ctn-pad" contenteditable="true"></div>';
				//$('#write-story').append(dt);
			}
			//console.log(length);
		});
	});
</script>
<div class="frame-home">
	<div class="compose" id="create">
		<div class="main">
			<div class="create-head">
				<h3>Create New Story</h3>
			</div>
			<div class="create-body">
				<div class="create-mn">

					<!--tool content-->
					<div class="tool">
						<ul>
							<form id="form-image" method="post" action="javascript:void(0)" enctype="multipart/form-data" onchange="getImage()">
								<input type="file" name="get-image" id="get-image" class="get">
							</form>
							<label for="get-image">
								<li>
									<span class="fa fa-lg fa-image"></span>
								</li>
							</label>
							<li onclick="opDialog('open', 'image-dialog')">
								<span class="fa fa-lg fa-globe"></span>
							</li>
							<li onclick="putToText('AHUY');">
								<span class="fa fa-lg fa-video-camera"></span>
							</li>
							<li onclick="opDialog('open', 'link-dialog')">
								<span class="fa fa-lg fa-link"></span>
							</li>
							<li onclick="opDialog('open', 'embed-dialog')">
								<span class="fa fa-lg fa-code"></span>
							</li>
						</ul>
					</div>

					<form id="form-publish" method="post" action="javascript:void(0)" enctype="multipart/form-data" onsubmit="publish()">
						<div class="create-block">

							<!--progress bar-->
							<div class="loading mrg-bottom" id="progressbar"></div>

							<div class="mrg-bottom">
								<input type="file" name="cover" id="cover" required="required" autofocus="autofocus" onchange="loadCover()">
								<label for="cover">
									<div class="cover-icon">
										<div class="icn">
											<span class="fa fa-lg fa-camera"></span>
											<span class="ttl-head">Choose Cover</span>
										</div>
										<div class="img">
											<div class="change-cover">
												<span>To change cover just click again.</span>
											</div>
											<img src="" alt="image" id="image-preview">
										</div>
									</div>
								</label>
							</div>

							<p>Story Title</p>
							<input type="text" name="title" class="mrg-bottom txt txt-main-color txt-box-shadow" id="title-story" required="required">

							<p>Write your Story Here</p>
							<div class="edit-text txt-main-color txt-box-shadow ctn ctn-main ctn-serif" id="write-story" contenteditable="true"></div>

						</div>
						<!--
						<div class="create-block">
							<span class="ttl-head">Set as Adult Content</span>
							<span class="toggle fa fa-lg fa-toggle-off" id="adult" onclick="opToggle('adult')"></span>
						</div>
						<div class="create-block">
							<span class="ttl-head">Disable Commenting</span>
							<span class="toggle fa fa-lg fa-toggle-off" id="comment" onclick="opToggle('comment')"></span>
						</div>
						-->
						<div class="create-block">
							<div class="place-tags">
								<p>Add Tags</p>
								<input type="text" name="tags" id="tags-story" class="tg txt txt-main-color txt-box-shadow" placeholder="Tags1, Tags2, Tags N...">
							</div>
						</div>
						<div class="create-bot">
							<input type="submit" name="save" class="btn btn-main-color" value="Publish" id="btn-publish">
						</div>
					</form>

				</div>
			</div>
		</div>

		<!--navigator-->
		<div class="create-dialog" id="image-dialog">
			<div class="place-dialog">
				<div class="top">
					Image URL
				</div>
				<div class="mid">
					<input type="text" name="image-url" class="txt txt-primary-color" placeholder="http://" id="image-url">
				</div>
				<div class="bot">
					<input type="button" name="put" class="btn btn-primary-color" value="Cancel" onclick="opDialog('hide')">
					<input type="button" name="put" class="btn btn-main-color" value="Place" onclick="getImageUrl()">
				</div>
			</div>
		</div>
		<div class="create-dialog" id="link-dialog">
			<div class="place-dialog">
				<div class="top">
					Link URL
				</div>
				<div class="mid">
					<input type="text" name="link-url" class="txt txt-primary-color" placeholder="http://" id="link-url">
				</div>
				<div class="bot">
					<input type="button" name="put" class="btn btn-primary-color" value="Cancel" onclick="opDialog('hide')">
					<input type="button" name="put" class="btn btn-main-color" value="Place" onclick="getLinkUrl()">
				</div>
			</div>
		</div>
		<div class="create-dialog" id="embed-dialog">
			<div class="place-dialog">
				<div class="top">
					Embeded Code
				</div>
				<div class="mid">
					<input type="text" name="embed-code" class="txt txt-primary-color" placeholder="Code" id="embed-code">
				</div>
				<div class="bot">
					<input type="button" name="put" class="btn btn-primary-color" value="Cancel" onclick="opDialog('hide')">
					<input type="button" name="put" class="btn btn-main-color" value="Place" onclick="getEmbed()">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection