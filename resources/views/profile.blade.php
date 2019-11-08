@extends("layouts.MainLayout")
@section("title")

{{Auth::user()->owner->fullName}} ({{ Auth::user()->username }})

@endsection
@section("content")



<div id="profileParent">
	<div class="container" id="profileHeading">
		<div id="profileImageParent">
			<div id="profileImage" class="">
				@auth
					@if(count(Auth::user()->owner->photos) > 0)
						@if(Auth::user()->owner_type == 'App\NormalUser')
							<img src="/storage/images/normalUsers/{{Auth::user()->owner->photos()->where('status',1)->first()->path}}" class="" style="border">
						@else
							<img src="/storage/images/doctors/{{Auth::user()->owner->photos()->where('status',1)->first()->path}}" class="">
						@endif
					@else
						<span class="fal fa-user" id="no-image"></span>
					@endif
				@endauth
				@guest
					<div class="alert alert-warning text-center">Need to be authenticated first!!</div>
				@endguest
			</div>
		</div>
		<div id="profileShortInfoParent">
			@auth
				<h2>{{ Auth::user()->username }}</h2>
				<a href="#" class="btn btn-md" id="editButton"><i class="fad fa-edit"></i> Edit Profile</a>

				<div id="largeScreenBio">
					<h5>{{ Auth::user()->owner->fullName }}</h5>
					@if(Auth::user()->owner->Bio)
						<p>{{ Auth::user()->owner->Bio }}</p>
					@else
						<p>No Bio...</p>
					@endif
				</div>
			@endauth
		</div>
		<div class="clearfix"></div>
		<div id="smallScreenBio">
			<h5>{{ Auth::user()->owner->fullName }}</h5>
			@if(Auth::user()->owner->Bio)
				<p>{{ Auth::user()->owner->Bio }}</p>
			@else
				<p>No Bio...</p>
			@endif
		</div>
	</div>

<!-- second part -->
@auth
<div id="pofileContentPart" class="container">
	
		<div id="tabs">
				@if(Auth::user()->owner_type == 'App\Doctor')
					<button class="tabLinks active" onclick="openContent(event,'posts')">
						<span class="fal fa-th btn-icon-large"></span> 
						<span class="fal fa-th btn-icon"></span> 
						<span class="btnText">Posts</span>
					</button>
					<button class="tabLinks" onclick="openContent(event,'achievements')">
						<span class="fad fa-graduation-cap btn-icon-large"></span>
						<span class="fal fa-graduation-cap btn-icon"></span>
						<span class="btnText">Achievements</span>
					</button>
					<button class="tabLinks" onclick="openContent(event,'followers')">
						<span class="fad fa-users btn-icon-large"></span> 
						<span class="fal fa-users btn-icon"></span> 
						<span class="btnText">Followers</span>
					</button>
					<button class="tabLinks" onclick="openContent(event,'fullInfo')">
						<span class="fad fa-info-square btn-icon-large"></span> 
						<span class="fal fa-info-square btn-icon"></span> 
						<span class="btnText">Full Info</span>
					</button>
				@else
					<button class="tabLinks active" onclick="openContent(event,'favorites')">
						<span class="fas fa-bookmark btn-icon-large"></span> 
						<span class="fal fa-bookmark btn-icon"></span> 
						<span class="btnText">Favorites</span>
					</button>
					<button class="tabLinks" onclick="openContent(event,'questions')">
						<span class="fad fa-question-square btn-icon-large"></span> 
						<span class="fal fa-question-square btn-icon"></span> 
						<span class="btnText">Questions</span>
					</button>
					<button class="tabLinks" onclick="openContent(event,'following')">
						<span class="fad fa-users btn-icon-large"></span> 
						<span class="fal fa-users btn-icon"></span> 
						<span class="btnText">Following</span>
					</button>
					<button class="tabLinks" onclick="openContent(event,'fullInfoUser')">
						<span class="fad fa-info-square btn-icon-large"></span> 
						<span class="fal fa-info-square btn-icon"></span> 
						<span class="btnText">Full Info</span>
					</button>
				@endif
		</div>
</div>

<div class="container">
@if(Auth::user()->owner_type == 'App\Doctor')
	<div id="posts" class="tab-content">
	@if(count(Auth::user()->owner->posts) > 0)
		@foreach(Auth::user()->owner->posts as $post)

			<div id="postPic">
				<div class="dropdown-divider col-10" id="divider"></div>
				<a href="{{route('profile',$post->owner->account->username)}}">
					@if(count($post->owner->photos) > 0)
						<img src="/storage/images/doctors/{{$post->owner->photos()->where('status',1)->first()->path}}">
					@else
						<span class="fal fa-user" id="no-image-in-post"></span>
					@endif
					<div id="ownerName">
						<span>{{$post->owner->fullName}}</span>
						<span id="createTime">{{$post->created_at->diffForHumans()}}</span>
					</div>
				</a>
			</div>
			<div id="postContent">
				<h5>{{$post->title}}</h5>
				<div id="postImage" class="text-center">
					<img src="{{asset('images/section1.jpg')}}" class="img-fluid">
				</div>
				<p>{{ $post->content }}</p>
			</div>
			<div class="clearfix"></div>
			<div id="commentPart">
				<div id="commentPartImage" style="background-color: ;">
						@if(count(Auth::user()->owner->photos) > 0)
							@if(Auth::user()->owner_type == 'App\NormalUser')
								<img src="/storage/images/normalUsers/{{Auth::user()->owner->photos()->where('status',1)->first()->path}}" class="" style="border">
							@else
								<img src="/storage/images/doctors/{{Auth::user()->owner->photos()->where('status',1)->first()->path}}" class="">
							@endif
						@else
							<span class="fal fa-user" id="no-image-in-comment"></span>
						@endif
				</div>
				<div id="comment">
					{!! Form::open(["style"=>"display:inline-block;"]) !!}			
						<div class="input-group">
							{!! Form::textarea("comment",null,["class"=>"form-control commentField","placeholder"=>"Add Comment...","id"=>"commentField-$post->id","rows"=>"1","onkeyup"=>"do_resize_and_enable_button(this,$post->id)"]) !!}
							{!! Form::file("photo",["class"=>"form-control commentPhotoField","disable"=>"true","id"=>"commentPhotoField-$post->id"]) !!}
							{!! Form::submit("Add Comment",["class"=>"btn  btn-sm addCommentBtn","id"=>"addCommentBtn-$post->id","disabled"=>"true","onclick"=>"validateCommentForm($post->id)"]) !!}
							<i class="fal fa-camera commentPhotoButton" id="commentPhotoButton-$post->id" onclick="openCommentPhotoField({{$post->id}})"></i>
						</div>
					{!! Form::close() !!}
				</div>
			</div>

		@endforeach
	@endif
	</div>
	<div id="achievements" class="tab-content">
		This is achivements parts
	</div>
	<div id="followers" class="tab-content">
		Thisis followrs part
	</div>
	<div id="fullInfo" class="tab-content"> 
		This is full info part
	</div>
@else
	<div id="favorites" class="tab-content">
		This is favorite Part
	</div>
	<div id="questions" class="tab-content">
		This is questions parts
	</div>
	<div id="following" class="tab-content">
		Thisis following part
	</div>
	<div id="fullInfoUser" class="tab-content"> 
		This is full info part user
	</div>
@endif
</div>
@endauth

</div>
 

@endsection