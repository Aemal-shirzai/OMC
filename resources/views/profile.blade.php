@extends("layouts.MainLayout")
@section("title")

{{$user->owner->fullName}} ({{ $user->username }})

@endsection
@section("content")

<div id="profileParent">
	
	<div class="container" id="profileHeading">
		<div id="profileImageParent">
			<div id="profileImage" class="">
				
				@if(count($user->owner->photos) > 0)
					@if($user->owner_type == 'App\NormalUser')
						<img src="/storage/images/normalUsers/{{$user->owner->photos()->where('status',1)->first()->path}}" class="" style="border">
					@else
						<img src="/storage/images/doctors/{{$user->owner->photos()->where('status',1)->first()->path}}" class="">
					@endif
				@else
					<span class="fal fa-user" id="no-image"></span>
				@endif
				
			</div>
		</div>
		<div id="profileShortInfoParent">
			
				<h2>{{ $user->username }}</h2>
				@auth
					@if(Auth::user()->username == $user->username)
						<a href="#" class="btn btn-md editFollowBtn"><i class="fad fa-edit"></i> Edit Profile</a>
					@else
						<a href="#" class="btn btn-md editFollowBtn"><i class="fad fa-plus"></i> Follow</a>
					@endif
				@endauth
				<div id="largeScreenBio">
					<h5>{{ $user->owner->fullName }}</h5>
					@if($user->owner->Bio)
						<p>{{ $user->owner->Bio }}</p>
					@else
						<p>No Bio...</p>
					@endif
				</div>
		</div>
		<div class="clearfix"></div>
		<div id="smallScreenBio">
			<h5>{{ $user->owner->fullName }}</h5>
			@if($user->owner->Bio)
				<p>{{$user->owner->Bio }}</p>
			@else
				<p>No Bio...</p>
			@endif
		</div>
	</div>

<!-- second part -->

<div id="pofileContentPart" class="container">
	
		<div id="tabs">
				@if($user->owner_type == 'App\Doctor')
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
@if($user->owner_type == 'App\Doctor')
	<div id="posts" class="tab-content" >
	@if(count($user->owner->posts) > 0)
		@foreach($user->owner->posts as $post)

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
						@if($post->created_at)
							<span id="createTime">Posted:{{$post->created_at->diffForHumans()}}</span>
						@endif
					</div>
				</a>
			</div>
			<div id="postContent">
				<h5>{{$post->title}}</h5>
				@guest
				<div class="btn float-right shareBtnForGuest" id="shareBtn" title="All share options">
					<a href="#" onclick="openShareOptions({{$post->id}})">
						<span class="far fa-ellipsis-h optionsIcons"></span> 
					</a>
					<div class="shareOptions shareOptionsForGuest" id="shareOptions-{{$post->id}}">
						<p class="text-center">Share</p>
						<!-- <a href="" class="fab fa-facebook"> Facebook</a> -->
						{!! Share::page(route('post.show',$post->id),null,['class'=>'share','id'=>"share-facebook"],"<span>","</span>")->facebook() !!}
						<div class="dropdown-divider"></div>
						{!! Share::page(route('post.show',$post->id),null,['class'=>'share','id'=>"share-twitter"],"<span>","</span>")->twitter() !!}
						<div class="dropdown-divider"></div>
						{!! Share::page(route('post.show',$post->id),null,['class'=>'share','id'=>"share-linkedIn"],"<span>","</span>")->linkedin() !!}
						<div class="dropdown-divider"></div>
						{!! Share::page(route('post.show',$post->id),null,['class'=>'share','id'=>"share-whatsapp"],"<span>","</span>")->whatsapp() !!}
						<div class="dropdown-divider"></div>
						{!! Share::page(route('post.show',$post->id),null,['class'=>'share','id'=>"share-telegram"],"<span>","</span>")->telegram() !!}
					</div>
				</div>
				@endguest
				<div class="tags">
					<span><a href="#">Headic</a></a></span>
					<span><a href="#">Pain</a></span>
					<span><a href="#">Cancer</a></span>
					<span><a href="#">Calcium</a></span>
					<span><a href="#">Diabates</a></span>
					<span><a href="#">Headic</a></a></span>
					<span><a href="#">Pain</a></span>
					<span><a href="#">Cancer</a></span>
					<span><a href="#">Calcium</a></span>
					<span><a href="#">Diabates</a></span>
				</div>
				<div id="postImage" class="text-center">
					<img src="{{asset('images/section1.jpg')}}" class="img-fluid">
				</div>
				<p>{{ $post->content }}</p>
			</div>
			<div class="clearfix"></div>
			@auth
				<div class="options">
					<button class="btn" title="The answer was usefull">
						<a href="#">
							<span class="fal fa-arrow-alt-up optionsIcons"></span> 
							<span class="optionsText">Up-vote</span> 
							<span class="votes">. 2</span>
						</a>
					</button>
					<button class="btn" title="The answer was not usefull">
						<a href="#">
							<span class="fal fa-arrow-alt-down optionsIcons"></span> 
							<span class="optionsText">Down-vote</span>  
							<span class="votes">. 2</span>
						</a>
					</button>
					<button class="btn" title="Follow the post for lates update">
						<a href="#">
							<span class="fal fa-wifi optionsIcons"></span> 
							<span class="optionsText">Follow</span> 
							<span class="votes">. 2</span>
						</a>
					</button>
					<button class="btn" title="All comments for this post">
						<a href="#">
							<span class="fal fa-comment optionsIcons"></span> 
							<span class="optionsText">comment</span> 
							<span class="votes">. 2</span>
						</a>
					</button>
					<div class="btn float-right" id="shareBtn" title="All share options">
						<a href="#" onclick="openShareOptions({{$post->id}})">
							<span class="far fa-ellipsis-v optionsIcons"></span> 
						</a>
						<div class="shareOptions" id="shareOptions-{{$post->id}}">
							<p class="text-center">Share</p>
							<!-- <a href="" class="fab fa-facebook"> Facebook</a> -->
							{!! Share::page(route('post.show',$post->id),null,['class'=>'share','id'=>"share-facebook"],"<span>","</span>")->facebook() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('post.show',$post->id),null,['class'=>'share','id'=>"share-twitter"],"<span>","</span>")->twitter() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('post.show',$post->id),null,['class'=>'share','id'=>"share-linkedIn"],"<span>","</span>")->linkedin() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('post.show',$post->id),null,['class'=>'share','id'=>"share-whatsapp"],"<span>","</span>")->whatsapp() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('post.show',$post->id),null,['class'=>'share','id'=>"share-telegram"],"<span>","</span>")->telegram() !!}
						</div>
					</div>
				</div>
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
						{!! Form::open(["method"=>"post","action"=>"CommentController@store","files"=>"true"]) !!}		
							<div class="input-group">
								{!! Form::textarea("content",null,["class"=>"form-control commentField","placeholder"=>"Add Comment...","id"=>"commentField-$post->id","rows"=>"1","onkeyup"=>"do_resize_and_enable_button(this,$post->id)"]) !!}
								{!! Form::file("photo",["class"=>"commentPhotoField","id"=>"commentPhotoField-$post->id"]) !!}
								{!! Form::hidden("post_id",$post->id) !!}
								{!! Form::submit("Add Comment",["class"=>"btn  btn-sm addCommentBtn","id"=>"addCommentBtn-$post->id","disabled"=>"true","onclick"=>"validateCommentForm($post->id)"]) !!}
								<i class="fal fa-camera commentPhotoButton" id="commentPhotoButton-$post->id" onclick="openCommentPhotoField({{$post->id}})"></i>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			@endauth
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


</div>
 
@endsection
