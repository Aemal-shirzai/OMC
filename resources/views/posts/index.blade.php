@extends("../layouts.MainLayout")

@section("title", "OMC All Posts")

@section("content")

<div class="container" id="listParent" style="">
	<!-- Beggingon of : showiing 10 most followed doctors for normal users-->
	@can("normalUser_related",Auth::user())
	<div id="followDoctorParent" class="card">
		<div class="card-header"><span id="card-heading">The doctors may help you find your solutions.</span></div>
		<div class="card-body" id="" style="">
			@if(count($mostVotedDoctors) > 0)
			@foreach($mostVotedDoctors as $mostVotedDoctor)
				<!-- To list only the doctors which are not in the following list of current authenticted user -->
				@if(Auth::user()->owner->following()->where("doctors.id", "=" , $mostVotedDoctor->id)->count() < 1)
					<!-- This if check to display only 10 doctors -->
					@if($numberOfDoctors <= 10)
						<div id="doctorsFollowList">
								<div class="doctorImage" id="dcotorImage">
									@if($mostVotedDoctor->account->photos()->where('status',1)->first())
										<img src="/storage/images/doctors/{{$mostVotedDoctor->account->photos()->where('status',1)->first()->path}}" class="img-fluid">
									@else
										<span class="fal fa-user no-image-in-following"></span>
									@endif
								</div>

							<div class="followDoctor" id="followDoctor">
								<a href="{{route('profile',$mostVotedDoctor->account->username)}}" class="fullName">
									<span>{{$mostVotedDoctor->fullName}}</span>
								</a>
								<span class="followedBy">Followed By <span id="followCount-{{$mostVotedDoctor->id}}">{{$mostVotedDoctor->followed()->count()}}</span></span>
								
								@can("view",Auth::user())
								<a href="javascript:void(0)" class="btn btn-sm float-right followingButton" class="" id="followingButton-{{$mostVotedDoctor->id}}" onclick="followDoctor('{{$mostVotedDoctor->id}}')">
									<i class="{{ Auth::user()->owner->following()->where('doctors.id',$mostVotedDoctor->id)->first() ? 'fad fa-check' : 'fad fa-plus' }}" id="followButtonIcon-{{$mostVotedDoctor->id}}"></i>
									<span class="followingButtonText" id="followingButtonText-{{$mostVotedDoctor->id}}">
										@if(Auth::user()->owner->following()->where("doctors.id",$mostVotedDoctor->id)->first())
											Following
										@else
											Follow
										@endif
									</span>
								</a>
								@endcan
							</div>	
							<div class="dropdown-divider"></div>
						</div><!-- End of points div -->
					@endif
					<!--End of : This if check to display only 10 doctors for normal users-->
					@php
						$numberOfDoctors++;
					@endphp
				@endif
				<!-- End of : To list only the doctors which are not in the following list of current authenticted user -->
			@endforeach
			@if(count($mostVotedDoctors) == count(Auth::user()->owner->following))
				<h5 class="text-center mt-2" style="font-size: 12px;">You are following all doctors!</h5>
			@endif
			@endif
		</div> <!-- End of card body -->
	</div>	<!-- End of card -->
	@endcan
	<!-- End of : showiing 10 most followed doctors -->

	<!-- Beggingon of : showing some tips and options for doctors-->
	@can("Doctor_related",Auth::user())
	<div id="forDoctors">
		<div class="text-center">
		     <span class="fad fa-bullhorn col-12 text-center iconsForDoctors"></span>
		     Increase your publicity by accelerating your discovery through omc <a href="#">advertising</a>.
		</div>
		<div class="dropdown-divider"></div>
		<div id="" class="text-center">
		     <span class="fad fa-share-alt col-12 text-center iconsForDoctors"></span>
		      Share your knowladege regarding health with other by adding a <a href="#">post</a> to your profile.
		</div>
		<div class="dropdown-divider"></div>
		<div id="" class="text-center">
		     <span class="fad fa-star-half-alt col-12 text-center iconsForDoctors"></span>
		      Help poeple diffrentiate the right and wrong information by <a href="#">voting</a> others poeple work.
		</div>
	</div>
	@endcan
	<!-- End of : showing some tips and options for doctors -->

	<!-- Begginng of the part to show news and options for guests -->
	@guest
	<div id="Forguests">
		<div class="text-center">
		    <span class="fad fa-user-md-chat col-12 text-center iconsForDoctors"></span>
		      Find your medical experts regarding to their location, profession, and publicity. <a href="{{route('register')}}">Sign up</a> for free account.
		    <div class="text-center"> 
            	<a href="#" class="btn btn-sm forGuestsBtn">Find Doctors</a>
            </div>
		</div>
		<div class="dropdown-divider"></div>
		<div id="" class="text-center">
		    <span class="fad fa-question-circle col-12 text-center iconsForDoctors"></span>
		       Find and ask qustions ralated to medical and share your answers with others. <a href="{{route('register')}}">Sign up</a> for free account.
		    <div class="text-center"> 
                <a href="{{route('questions.create')}}" class="btn btn-sm forGuestsBtn">Ask Question</a>
                <a href="{{route('questions.index')}}" class="btn btn-sm forGuestsBtn">Find Qustion</a>
            </div>

		</div>
		<div class="dropdown-divider"></div>
		<div id="" class="text-center">
		    <span class="fas fa-ad col-12 text-center iconsForDoctors"></span>
		      Search and find the latest advertisements and share your advertisements through omc. <a href="{{route('register')}}">Sign up</a> for free account.
		    <div class="text-center"> 
               <a href="javascript:void(0)" id="forUsersViewAds" class="btn btn-sm forGuestsBtn">View ads</a>
               <a href="#" class="btn btn-sm forGuestsBtn">Add your ads</a>
            </div>
		</div>
	</div>
	@endguest
	<!-- End of the part to show news and options for guests -->

<!-- Begginng of title and sortBy options -->
	<div class="title">
		<h3>
			@if(empty($type))
				Latest Posts
			@endif
			@isset($type) 
				@if($type == "top") 
					Top Posts 
				@elseif($type == "down")
					Less Voted Posts
				@elseif($type == "mostFollowed")
					Most Followed Posts
				@endif 
			@endisset 
		</h3>
	</div>
	<div class="orderBy">
		<div class="orderByOptionParent float-right" style="">
			<a href="{{route('posts.index')}}" class="btn btn-sm ">
				@if(empty($type))<span class="fad fa-check"></span>@endif Latest
			</a>
			<a href="{{route('postsSortBy','top')}}" class="btn btn-sm">
				@isset($type)@if($type == "top")<span class="fad fa-check"></span>@endif @endisset 
				Most Voted
			</a>
			<a href="{{route('postsSortBy','down')}}" class="btn btn-sm ">
				@isset($type)@if($type == "down")<span class="fad fa-check"></span>@endif @endisset 
				Down Voted
			</a>
			<a href="{{route('postsSortBy','mostFollowed')}}" class="btn btn-sm ">@isset($type)@if($type == "mostFollowed")<span class="fad fa-check"></span>@endif @endisset Most Followed
			</a>
		</div>

		<span class="float-right sortText">SortBy:</span>
	</div>
<!-- End of title and sortBy options -->
<div class="clearfix"></div>
	<!-- Beggining of showing posts part -->
	@if(count($posts) > 0)
	@foreach($posts as $post)
		<div class="mainContent" id="mainContent-{{$post->id}}">
			<!-- owner information about post or questions -->
			<div class="ownerInfo" id="ownerInfo-{{$post->id}}">
				
					@if(count($post->owner->account->photos) > 0)
						<img src="/storage/images/doctors/{{$post->owner->account->photos()->where('status',1)->first()->path}}">
					@else
						<span class="fal fa-user" id="no-owner-image"></span>
					@endif
					<div id="ownerName">
						<a href="{{route('profile',$post->owner->account->username)}}"><span id="fullName">{{$post->owner->fullName}}</span> </a>
						@if($post->created_at)
							<span id="createTime">Posted:{{$post->created_at->diffForHumans()}}</span>
						@endif
					</div>
				
			</div>
			<!--End owner information about post or questions -->
			
			<!-- Beggingin of the content part -->
			<div id="content-{{$post->id}}" class="content col-12">
				<a href="{{route('posts.show',$post->id)}}"><h5 style="color: #3fbbc0;">{{$post->title}}</h5></a>
				<div class="tags">
					@if($post->tags()->count() > 0)
						@foreach($post->tags as $tag)
							<span><a href="#">{{$tag->category}}</a></span>
						@endforeach
					@endif
				</div>
				@if($post->content)
					<a href="{{route('posts.show',$post->id)}}" style="color: black;"><p>{{ Str::limit($post->content,300) }} <span class="readMoreLess" >View Full</span></a></p>
				@endif
			</div>
			<div class="clearfix"></div>
			<!-- End of the content part -->

			<!-- Beggining of opstions for posts -->
				<div class="options">
					<!-- Beggining of the posts options that should be visible only for auth users -->
					@auth
					<button class="btn OptionsForGuest"  title="The answer was usefull">
						<a href="javascript:void(0)">
							<span id="upVotedCheck-{{$post->id}}" @if(Auth::user()->postsVotes()->where(["type"=>1,"to_type"=>"App\Post","to_id"=>$post->id])->first())
								class = "fas fa-check upVotedCheck"
							 @endif ></span>

							<span class="fal fa-arrow-alt-up optionsIcons" id="postOptionsVoteUpIcon-{{$post->id}}" {{ Auth::user()->postsVotes()->where(["type"=>1,"to_type"=>"App\Post","to_id"=>$post->id])->first() ? "style=color:#3fbbc0;" : "" }}></span> 

							<span class="optionsText" id="postOptionsVoteUpText-{{$post->id}}" {{ Auth::user()->postsVotes()->where(["type"=>1,"to_type"=>"App\Post","to_id"=>$post->id])->first() ? "style=color:#3fbbc0;" : "" }}>Up-Votes</span>

							. <b><span class="votes" id="postOptionsVoteUpCount-{{$post->id}}">{{$post->votedBy()->where("type",1)->count()}}</span></b>
						</a>
					</button>
					<button class="btn OptionsForGuest" title="The answer was not usefull">
						<a href="javascript:void(0)">

							<span id="downVotedCheck-{{$post->id}}" @if(Auth::user()->postsVotes()->where(["type"=>0,"to_type"=>"App\Post","to_id"=>$post->id])->first())
								class = "fas fa-check upVotedCheck"
							 @endif></span>

							<span class="fal fa-arrow-alt-down optionsIcons" id="postOptionsDownVoteUpIcon-{{$post->id}}" {{ Auth::user()->postsVotes()->where(["type"=>0,"to_type"=>"App\Post","to_id"=>$post->id])->first() ? "style=color:#3fbbc0;" : "" }}></span> 

							<span class="optionsText" id="postOptionsDownVoteText-{{$post->id}}" {{ Auth::user()->postsVotes()->where(["type"=>0,"to_type"=>"App\Post","to_id"=>$post->id])->first() ? "style=color:#3fbbc0;" : "" }}>Down-Votes</span>  

							. <b><span class="votes" id="postOptionsVoteDownCount-{{$post->id}}">{{$post->votedBy()->where("type",0)->count()}}</span></b>
						</a>
					</button>
					@can("normalUser_related",Auth::user())
					<button class="btn {{ Auth::user()->owner->favoritePosts()->where(['fav_type'=>'App\Post','fav_id'=>$post->id])->first() ? 'followed' : '' }}" onclick="followPost('{{$post->id}}')" id="favoriteButton-{{$post->id}}" title="Follow the post for lates update">
						<a href="javascript:void(0)">
							<span class="fal fa-wifi optionsIcons"></span> 
							<span class="optionsText" id="followOptionText-{{$post->id}}">
								{{ Auth::user()->owner->favoritePosts()->where(['fav_type'=>'App\Post','fav_id'=>$post->id])->first() ? 'Un-follow' : 'Follow' }}
							</span> 
							. <b><span class="votes" id="favoritesPostCount-{{$post->id}}"> {{$post->favoritedBy()->count()}}</span></b>
						</a>
					</button>
					@endcan
					@can("Doctor_related",Auth::user())
					<button class="btn OptionsForGuest" title="Follow the post for lates update">
						<a href="javascript:void(0)">
							<span class="fal fa-wifi optionsIcons"></span> 
							<span class="optionsText">Followers</span> 
							<b><span class="votes">. {{$post->favoritedBy()->count()}}</span></b>
						</a>
					</button>
					@endcan
					<div class="confirmationBox" id="postConfirmationBox-{{$post->id}}">
						<div id="text">Are You Sure To Delete?</div>
						<div id="text"><small>Remember: There is no comeback</small></div>
						<a href="javascript:void(0)" onclick="deletePosts('{{$post->id}}')" class="btn btn-danger btn-sm">Remove</a>
						<a href="javascript:void(0)" onclick="postClosePermissionBox('{{$post->id}}')" class="btn btn-light btn-sm">Cancel</a>
					</div>
					@endauth
					<!-- End of the posts options that should be visible only for auth users -->

					<!-- Beggining of the posts options that should be visible only for gues users -->
					@guest
					<button class="btn OptionsForGuest" title="The answer was usefull. You have to Login First">
						<a href="javascript:void(0)">
							<span class="far fa-arrow-alt-up optionsIcons"></span> 
							<span class="optionsText">Up-votes</span> 
							<b><span class="votes">. {{$post->votedBy()->where("type",1)->count()}}</span></b>
						</a>
					</button>
					<button class="btn OptionsForGuest" title="The answer was not usefull. You have to Login First">
						<a href="javascript:void(0)">
							<span class="fal fa-arrow-alt-down optionsIcons"></span> 
							<span class="optionsText">Down-votes</span>  
							<span class="votes">. {{$post->votedBy()->where("type",0)->count()}}</span>
						</a>
					</button>
					<button class="btn OptionsForGuest" title="Follow the post for lates update. You have to Login First">
						<a href="javascript:void(0)">
							<span class="fal fa-wifi optionsIcons"></span> 
							<span class="optionsText">Followers</span> 
							<span class="votes">. {{$post->favoritedBy()->count()}}</span>
						</a>
					</button>
					@endguest
					<!-- End of the posts options that should be visible only for guest users -->

					<!-- Beggining of the posts options that should be visible for both the  auth users and guest users -->
					<button class="btn" title="All comments for this post">
						<a href="{{route('posts.show',$post->id)}}">
							<span class="fal fa-comment optionsIcons"></span> 
							<span class="optionsText">All comments</span> 
							.<b><span class="votes" id="commentcounts1-{{$post->id}}"> {{count($post->comments)}}</span></b>
						</a>
					</button>
					<!-- End of the posts options that should be visible for both the  auth users and guest users -->

					<div class="btn float-right" id="shareBtn" title="All share options">
						<a href="#" onclick="openShareOptions({{$post->id}})">
							<span class="far fa-ellipsis-v optionsIcons"></span> 
						</a>
						<div class="shareOptions" id="shareOptions-{{$post->id}}">
							@auth
							@if(Auth::user()->id === $post->owner->account->id)
							<p class="text-center">Manage</p>
							<span title="Edit Post">
								<li>
									<a href="{{route('posts.edit',$post->id)}}" class="PostEditDelete"><span class="fas fa-edit"></span> Edit</a>
								</li>
							</span>
							<span title="Delete Post">
								<li>
									<a href="javascript:void(0)" id="postDeleteOption-{{$post->id}}" class="PostEditDelete" onclick="openPostConfirmation('{{$post->id}}')"><span class="fas fa-trash"></span> <Span id="postDeleteText-{{$post->id}}">Delete</Span></a>
								</li>
							</span>
							@endif
							@endauth
							<!-- <div class="dropdown-divider"></div> -->
							<p class="text-center">Share</p>
							{!! Share::page(route('posts.show',$post->id),null,['class'=>'share','id'=>"share-facebook"],"<span>","</span>")->facebook() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('posts.show',$post->id),null,['class'=>'share','id'=>"share-twitter"],"<span>","</span>")->twitter() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('posts.show',$post->id),null,['class'=>'share','id'=>"share-linkedIn"],"<span>","</span>")->linkedin() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('posts.show',$post->id),null,['class'=>'share','id'=>"share-whatsapp"],"<span>","</span>")->whatsapp() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('posts.show',$post->id),null,['class'=>'share','id'=>"share-telegram"],"<span>","</span>")->telegram() !!}
						</div>
					</div>
				</div>
				
			<!-- End of opstions for posts -->
			
		</div>
	@endforeach
	{{ $posts->links() }}
	@else
	<h4>No Post found to display!</h4>
	@endif
</div>


@section("scripts")
<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';
	

		// This route is to add post to favorite
		var postFavorites = '{{route("postFavorites")}}';

		// This route is to add and remove doctors to follow by normal user
		var DoctorFollow = '{{route("DoctorFollow")}}';

		// This route is delete the post by post owner
		var deletePost = '{{route("deletePost")}}';
	</script>

@endsection

@endsection