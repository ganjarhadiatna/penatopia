@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-home frame-edit">
	<div class="compose" id="create">
		<div class="main">
			<div class="create-head">
				<h3>Change Password</h3>
			</div>
			<div class="edit-body">
				@foreach ($profile as $p)
				<form id="form-edit-profile" method="post" action="javascript:void(0)">
					<div class="edit-block">
						<div class="place-edit">
							<div class="pe-1">
								<span class="fa fa-lg fa-key"></span>
							</div>
							<div class="pe-2">
								<input type="text" name="old-password" class="txt txt-primary-color" id="old-password" required="true" value="{{ $p->name }}">
							</div>
						</div>
						<br>
						<div class="place-edit">
							<div class="pe-1">
								<span class="fa fa-lg fa-key"></span>
							</div>
							<div class="pe-2">
								<input type="text" name="new-password" class="txt txt-primary-color" id="new-password" required="true" value="{{ $p->email }}">
							</div>
						</div>
						<div class="place-edit">
							<div class="pe-1">
								<span class="fa fa-lg fa-key"></span>
							</div>
							<div class="pe-2">
								<input type="text" name="renew-password" class="txt txt-primary-color" id="renew-password" value="{{ $p->website }}">
							</div>
						</div>
						<div class="place-edit">
							<div class="pe-2 pe-btn">
								<input type="submit" name="edit-save" class="btn btn-main-color" value="Change Password">
								<input type="button" name="edit-save" class="btn btn-primary-color" value="Cancel">
							</div>
						</div>
					</div>
				</form>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection