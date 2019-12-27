@extends("../layouts.MainLayout")

@section("title","Admin Panel Advertisements")

@section("content")
@include("../layouts.adminLayout")

<div id="main">
	<h4>Notifications</h4>
	<div class="dropdown-divider"></div>
		<div class="notificationsTab">
			<h4>Post notifications</h4>
			@if(Auth::user()->notifications()->where("type","=","App\Notifications\Admin\postAdd")->count() > 0)
			 	@foreach(Auth::user()->notifications()->where("type","=","App\Notifications\Admin\postAdd")->get() as $postNotification)
					<a href="{{route('posts.show', $postNotification->data['post']['id'])}}" class="{{($postNotification->read_at == '' ? 'notRead' : '')}}" onclick="markAsRead('{!! $postNotification->id !!}')">A New Post has been added
					@if($postNotification->read_at == '')
						<span class="badge badge-danger newOrNot">New</span>
					@else
							<span class="newOrNot far fa-check" style="color: #3fbbc0;"></span>
					@endif
					<small class="d-block">{{$postNotification->created_at->diffForHumans()}}</small>
					</a>
				@endforeach
			@else
			<h4>No notifications!</h4>
			@endif
		</div>
		<div class="notificationsTab">
			<h4>Questions notifications</h4>
			@if(Auth::user()->unreadnotifications()->where("type","=","App\Notifications\Admin\questionAdd")->count() > 0)
			 	@foreach(Auth::user()->notifications()->where("type","=","App\Notifications\Admin\questionAdd")->get() as $questionNotification)
					<a href="{{route('questions.show', $questionNotification->data['question']['id'])}}" class="{{($questionNotification->read_at == '' ? 'notRead' : '')}}" onclick="markAsRead('{!! $questionNotification->id !!}')">
						A New Question has been added
						@if($questionNotification->read_at == '')
							<span class="badge badge-danger newOrNot">New</span>
						@else
							<span class="newOrNot far fa-check" style="color: #3fbbc0;"></span>
						@endif
						<small class="d-block">{{$questionNotification->created_at->diffForHumans()}}</small>
					</a>
				@endforeach
			@else
				<h4>No notifications!</h4>
			@endif
		</div>
		<div class="notificationsTab">
			<h4>Users notifications</h4>
			@if(Auth::user()->notifications()->where("type","=","App\Notifications\Admin\userAdd")->count() > 0)
			 	@foreach(Auth::user()->notifications()->where("type","=","App\Notifications\Admin\userAdd")->get() as $userNotification)
					<a href="{{route('profile', $userNotification->data['user']['username'])}}" class="{{($userNotification->read_at == '' ? 'notRead' : '')}}" onclick="markAsRead('{!! $userNotification->id !!}')">A New user regiseterd to system
					@if($userNotification->read_at == '')
						<span class="badge badge-danger newOrNot">New</span>
					@else
							<span class="newOrNot far fa-check" style="color: #3fbbc0;"></span>
					@endif
					<small class="d-block">{{$userNotification->created_at->diffForHumans()}}</small>
					</a>
				@endforeach
			@else
				<h4>No notifications!</h4>
			@endif
		</div>
</div>

@endsection



@section("scripts")


<script type="text/javascript">
	
</script>	

@endsection