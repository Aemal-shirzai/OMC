@extends("../layouts.MainLayout")

@section("title","Admin Panel Messages")

@section("content")
@include("../layouts.adminLayout")

<div id="main">
	<h4>Messages</h4>
	<div class="dropdown-divider"></div>
	<!-- details part -->
	@if(count($messages) > 0)
		@foreach($messages as $message)
		<div class="confirmationBox" id="messageConfirmationBox-{{$message->id}}">
			<div class="text">Are You Sure To Delete?</div>
			<div class="text"><small>Remember: There is no comeback</small></div>
			<a href="javascript:void(0)" onclick="deleteMessages('{{$message->id}}')" class="btn btn-danger btn-sm">Delete</a>
			<a href="javascript:void(0)" onclick="messageClosePermissionBox('{{$message->id}}')" class="btn btn-light btn-sm">Cancel</a>
		</div>
		<div class="fullMessage" id="fullMessage-{{$message->id}}">
			<div class="details">
				<div class="from">
					<span class="icons" style="font-size: 12px;"><b>From:</b></span>
					<span class="info fullName">{{ $message->fullName}}</span>
				</div>
				<div class="time" class=""> 
					<span class="far fa-calendar icons"></span>
					<span class="info date">{{ $message->created_at->diffForHumans()}}</span>
				</div>
				<div class="email" class="">
					<span class="far fa-envelope icons"></span>
					<span class="info"><a  href="mailto:{{$message->emailAddress}}">{{ $message->emailAddress }}</a></span>
				</div>
				<div class="phone" class="">
					<span class="far fa-phone icons"></span>
					<span class="info"><a  href="tel:+93{{$message->phoneNumber}}">{{$message->phoneNumber}}</a></span>
				</div>
				@if($message->owner)
				<div class="user">
					<span class="far fa-user icons"></span>
					<span class="info">
						<a href="{{route('profile',$message->owner->username)}}">
							View sender profile
						</a>
					</span>
				</div>
				@endif
				<div class="delete" class="">
					<a  href="javascript:void(0)" class="deleteButton" onclick="openMessageConfirmation('{{$message->id}}')">
						<span class="far fa-trash icons"></span>
						<span class="info" id="deletText-{{$message->id}}">Delete</span><img src="{{asset('images/load3.gif')}}" class="load" id="deleteLoad-{{$message->id}}">
					</a>
				</div>
			</div>
			<div class="messages">
				{{$message->message}}
			</div>
			<div class="clearfix"></div>
			<div class="dropdown-divider"></div>
		</div>
		@endforeach
	@endif

</div>

@endsection




@section("scripts")

<script type="text/javascript">
	var token = "{{ Session::token() }}";
	var deleteMessage = "{{ route('contact.delete') }}";
</script>

@endsection