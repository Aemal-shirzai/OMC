@extends("layouts.MainLayout")
@section("title")

{{$user->owner->fullName}} ({{ $user->username }})

@endsection
@section("content")
<div id="profileParent">
	<div class="container" id="profileHeading">
		<div id="profileImageParent">
			<div id="profileImage" class="">
				
				@if(count($user->photos) > 0)
					@if($user->owner_type == 'App\NormalUser')
						<img src="/storage/images/normalUsers/{{$user->photos()->where('status',1)->first()->path}}" >
					@else
						<img src="/storage/images/doctors/{{$user->photos()->where('status',1)->first()->path}}" class="">
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
						@if($user->owner_type == "App\Doctor")
							<a href="#" class="btn btn-md editFollowBtn"><i class="fad fa-plus"></i> Follow</a>
						@endif
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
						@if(count($post->owner->account->photos) > 0)
							<img src="/storage/images/doctors/{{$post->owner->account->photos()->where('status',1)->first()->path}}">
						@else
							<span class="fal fa-user" id="no-image-in-post"></span>
						@endif
						<div id="ownerName">
							<span id="fullName">{{$post->owner->fullName}}</span> 
							@if($post->created_at)
								<span id="createTime">Posted:{{$post->created_at->diffForHumans()}}</span>
							@endif
						</div>
					</a>
				</div>
				<!-- start of div of postContent -->
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
					<div id="postImage" class="text-center">
						<img src="{{asset('images/bg-banner.jpg')}}" class="">
					</div>
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
					<p>{{ $post->content }}</p>
				</div>
				<!-- End of div of postContent -->
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
						<button class="btn" title="All comments for this post" onclick="showAllComments({!!$post->id!!})">
							<a href="javascript::void(0)">
								<span class="fal fa-comment optionsIcons"></span> 
								<span class="optionsText">comments</span> 
								<span class="votes">. {{count($post->comments)}}</span>
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

					<!--Begginning  comments part  -->
					<div id="commentPart">
							<!-- Beggining of all comments part -->
							<div class="allComments" id="allComments-{{$post->id}}">
								@if(count($post->comments) > 0)
									<div class="mb-2 ml-2">{{count($post->comments)}} Comments</div>
									@foreach($post->comments as $comment)
										<!-- Beggining of: Image part of comment owner -->
										<div class="allcommentsOwnerImage">
											@if(count($comment->comment_owner->photos) > 0)							
												@if($comment->comment_owner->owner_type == "App\Doctor")
													<img src="/storage/images/doctors/{{$comment->comment_owner->photos()->where('status','1')->first()->path}}">
												@else
													<img src="/storage/images/normalUsers/{{$comment->comment_owner->photos()->where('status','1')->first()->path}}">
												@endif
											@else
												<span class="fal fa-user" id="no-image-in-comment"></span>
											@endif
											<div class="commentOwnerName">
												<a href="{{route('profile',$comment->comment_owner->username)}}"><span>{{$comment->comment_owner->owner->fullName}}</span></a> 
												@if($comment->created_at)
													<span class="commentcreateTime">Commented:{{$comment->created_at->diffForHumans()}}</span>
												@endif
											</div>
										</div>
										<!-- End of: Image part of comment owner -->

										<!-- Beggining of : all comments content part -->
										<div class="allCommentsContent" id="allCommentsContent-{{$comment->id}}">
											@if(count($comment->photos) > 0)
												<div id="postImage" class="text-center" style="overflow: hidden;">
													<a href="/storage/images/comments/{{$comment->photos()->where('status',1)->first()->path}}">
														<img src="/storage/images/comments/{{$comment->photos()->where('status',1)->first()->path}}" class="">
													</a>
												</div>
											@endif
											<p>
												@if($comment->content)
													{{$comment->content}}
												@endif
											</p>
										</div>
										<!-- End of: Image part of comment owner -->

										<!-- Beggining of: options for comments -->
										<div class="commetOptions">
											<button class="btn" title="Reply" onclick="showReplies({!! $comment->id !!})">
												<a href="javascript:void(0)">
													<span class="fal fa-reply commentOptionsIcons"></span>  
													<span class="commentVotes">. {{count($comment->replies)}}</span>
												</a>
											</button>
											<button class="btn" title="The answer was usefull">
												<a href="#">
													<span class="fal fa-arrow-alt-up commentOptionsIcons"></span> 
													<span class="commentVotes">. 2</span>
												</a>
											</button>
											<button class="btn" title="The answer was not usefull">
												<a href="#">
													<span class="fal fa-arrow-alt-down commentOptionsIcons"></span>  
													<span class="commentVotes">. 2</span>
												</a>
											</button>
										</div>
										<!-- End of :options for comments-->

										<!-- Note: this div is used to show the error messages of both client side and serverside NOTE:ids names are confusing here -->
										<div class="alert alert-danger replyImageVideoErrorMsg" id="replyPhotoError-{{$comment->id}}" >
											<button class="close" onclick="closeReplyMsgs({!! $comment->id !!})">&times;</button>
											<span id="replymsg-{{$comment->id}}">
												@error('replyPhoto')
													{{ $message }}
												@enderror
											</span>
										</div>
										<!-- Note:  Reply Success messages -->
										@if(session("replySuccess"))
										<!-- 
											* I have added the id for this div for two reasons:
											* 1- because to scroll down to it when the responise come back from the serveer
											* 2- to make its display availible usring js. Because if i just relay on the the session if statemetn
											* then when the request response come then it show the smae messagses above all the comments.			
										 -->
											<div class="alert alert-success replySuccessMsgs" id="replySuccessMsg-{{$comment->id}}">
												<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
													{{session('replySuccess')}}
											</div>
										@endif

										<!-- Beggining of the part which display the reply image after its beign selected -->
										<div class="commentImageDiv" id="replyImageDiv-{{$comment->id}}">
					    					<button class="close removeImage" onclick="removeReplyImage({!! $comment->id !!})">&times; 
					    						<span class="removeEditCommentPhotoText"> Remove photo</span>
					    					</button>
					    					<a href="javascript:void(0)" class="fal fa-edit ml-2" onclick="openReplyPhotoField({!!$comment->id!!})">
					    						<span class="removeEditCommentPhotoText">Change photo</span>
					    					</a>
					    					<div class="text-center" style="overflow: hidden;">
												<img src="" id="replyImg-{{$comment->id}}" >
											</div>
										</div>
										<!-- End of the part which display the reply image after its beign selected -->

										<!-- Beggining of form for replies -->
										<div class ="reply" id="reply-{{$comment->id}}">
											{!! Form::open(["method"=>"post","action"=>"CommentReplyController@store","files"=>"true"]) !!}		
												<div class="input-group">
													{!! Form::file("replyPhoto",["class"=>"replyPhotoField","id"=>"replyPhotoField-$comment->id","onchange"=>"showAndValidateReplyFile($comment->id)"]) !!}
													<textarea  name="content" class="form-control replyField" placeholder="Add Reply..." id="replyField-{{$comment->id}}" rows="1"
													onkeyup="do_resize_and_enable_reply_button(this,{!! $comment->id !!})"  value= @if(old("comment_id") == $comment->id) {{old("content")}} @else "" @endif></textarea>
													<input type="hidden" name="comment_id" value= @if(old("comment_id") == $comment->id) {{old("comment_id")}} @else {{$comment->id}} @endif >
													{!! Form::submit("Reply",["class"=>"btn  btn-sm addReplyBtn","id"=>"addReplyBtn-$comment->id","disabed"=>"true","onclick"=>"validateReplyForm($comment->id)"]) !!}
													<i class="fal fa-camera replyPhotoButton" id="replyPhotoButton-{{$comment->id}}" onclick="openReplyPhotoField({!!$comment->id!!})"></i>
												</div>
											{!! Form::close() !!}
										</div>
										<!-- End of form for replies -->
										<div class="dropdown-divider" id="dividerForComments"></div>
									@endforeach
								@else
									<span class="no-comment">No Comment</span>	
								@endif
							</div>
							<!-- End of : all comments content part -->
							
						
						<div class="clearfix"></div>
						<!-- End Showing all comments part  -->
				

						<!-- Note: this div is used to show the error messages of both client side and serverside NOTE:ids names are confusing here -->
						<div class="alert alert-danger commentImageVideoErrorMsg" id="fileError-{{$post->id}}" >
							<button class="close" onclick="closeMsgs({!! $post->id !!})">&times;</button>
							<span id="msg-{{$post->id}}">
								@error('photo')
									{{ $message }}
								@enderror
							</span>
						</div>
						<!-- Note: Success messages -->
						@if(session("commentSuccess"))
						<!-- 
							* I have added the id for this div for two reasons:
							* 1- because to scroll down to it when the responise come back from the serveer
							* 2- to make its display availible usring js. Because if i just relay on the the session if statemetn
							* then when the request response come then it show the smae messagses above all the comments.			
						 -->
							<div class="alert alert-success commentSuccessMsgs" id="successMsg-{{$post->id}}">
								<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
									{{session('commentSuccess')}}
							</div>
						@endif
						<div class="commentImageDiv" id="commentImageDiv-{{$post->id}}" style="">
	    					<button class="close removeImage" onclick="removeImage({!! $post->id !!})" >
	    						&times; 
	    						<span class="removeEditCommentPhotoText"> Remove photo</span>
	    					</button>
	    					<a href="javascript:void(0)" class="fal fa-edit ml-2" onclick="openCommentPhotoField({!!$post->id!!})">
	    						<span class="removeEditCommentPhotoText">Change photo</span>
	    					</a>
	    					<div class="text-center" style="overflow: hidden;">
								<img src="" id="commentImg-{{$post->id}}" >
							</div>
						</div>
						<div id="commentPartImage">
								@if(count(Auth::user()->owner->account->photos) > 0)
									@if(Auth::user()->owner_type == 'App\NormalUser')
										<img src="/storage/images/normalUsers/{{Auth::user()->owner->account->photos()->where('status',1)->first()->path}}" class="" >
									@else
										<img src="/storage/images/doctors/{{Auth::user()->owner->account->photos()->where('status',1)->first()->path}}" class="">
									@endif
								@else
									<span class="fal fa-user" id="no-image-in-comment"></span>
								@endif
						</div>
						<div id="comment">
							{!! Form::open(["method"=>"post","action"=>"CommentController@store","files"=>"true"]) !!}		
								<div class="input-group">
									{!! Form::file("photo",["class"=>"commentPhotoField","id"=>"commentPhotoField-$post->id","onchange"=>"showAndValidateFile($post->id)"]) !!}
									<textarea  name="content" class="form-control commentField" placeholder="Add Comment to post..." id="commentField-{{$post->id}}" rows="1"
									onkeyup="do_resize_and_enable_button(this,{!! $post->id !!})" value= @if(old("post_id") == $post->id) {{old("content")}} @else "" @endif></textarea>
									<input type="hidden" name="post_id" value= @if(old("post_id") == $post->id) {{old("post_id")}} @else {{$post->id}} @endif >
									{!! Form::submit("Add Comment",["class"=>"btn  btn-sm addCommentBtn","id"=>"addCommentBtn-$post->id","disabled"=>"true","onclick"=>"validateCommentForm($post->id)"]) !!}
									<i class="fal fa-camera commentPhotoButton" id="commentPhotoButton-$post->id" onclick="openCommentPhotoField({!!$post->id!!})"></i>
								</div>
							{!! Form::close() !!}
						</div>
					</div>
					<!-- End of comment part -->
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

@section("scripts")
	@if(session('post_id'))
		<script type="text/javascript">
			var scroll = "on";
			var post_id = {!! json_encode(session('post_id')) !!};
		</script>
	@endif
<!-- Error msgs of adding comment -->
	@error("photo")
		<script type="text/javascript">
			var scroll = "on1";
			var post_id = {!! json_encode(old("post_id")) !!};
		</script>
	@enderror

@endsection