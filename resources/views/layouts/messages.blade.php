 @if(count($errors) > 0)
	@foreach($errors->all() as $error)
		<div class="alert alert-danger text-center col-12 messages mb-3">
			<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
			{{ $error }}
		</div>
	@endforeach
@endif