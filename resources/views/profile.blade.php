@extends("layouts.MainLayout")
@section("title")

{{$user->owner->fullName}} ({{ $user->username }})

@endsection
@section("content")
<div id="profileParent" style="position: relative;">
	<div>
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

	@auth
		@if(Auth::user()->owner_type == 'App\Doctor' && Auth::user()->username == $user->username)
			<!-- Beggining of the div which shows the tags of doctors in profile page -->
			<div id="tags" style="top: 130px;">
				Your Tags
					<a href="#">tag1</a>
					<a href="#">tag2</a>
					<a href="#">tag3</a>
					<a href="#">tag4</a>
					<a href="#">tag5</a>
					<a href="#">tag6</a>
			</div>
			<!-- End of the div which shows the tags of doctors in profile page -->
		@endif
	@endauth
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

				<!-- Beggining of post owne pic -->
				
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
				<!-- End of post owne pic -->
				
				<!-- start of div of postContent -->
				<div id="postContent" class="col-12">
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
						<span><a href="#">Headic</a></span>
						<span><a href="#">Pain</a></span>
						<span><a href="#">Cancer</a></span>
						<span><a href="#">Calcium</a></span>
						<span><a href="#">Diabates</a></span>
						<span><a href="#">Headic</a></span>
						<span><a href="#">Pain</a></span>
						<span><a href="#">Cancer</a></span>
						<span><a href="#">Calcium</a></span>
						<span><a href="#">Diabates</a></span>
					</div>
					@if($post->content)
						@if(strlen($post->content) > 1000)
							<p id="halfPost-{{$post->id}}">
								{{ Str::limit($post->content,1000)}} 
								<a href="javascript:void(0)" class="readMoreLess" onclick="showComplete({!! $post->id !!},'post')">Read More...</a>
							</p>
							<p id="completePost-{{$post->id}}" style="display: none;">
								{{ $post->content}}
								<a href="javascript:void(0)" class="readMoreLess" onclick="showLess({!! $post->id !!},'post')">Read Less...</a>
							</p>
						@else
							<p>{{ $post->content }}</p>
						@endif
					@endif
				</div>
				<!-- End of div of postContent -->

				<div class="clearfix"></div>
					<div class="options">

						<!-- Beggining of the posts options that should be visible only for auth users -->
						@auth
						<button class="btn" onclick="vote('{{$post->id}}','upVote')" title="The answer was usefull">
							<a href="javascript:void(0)">
								<span id="upVotedCheck-{{$post->id}}" @if(Auth::user()->postsVotes()->where(["type"=>1,"to_type"=>"App\Post","to_id"=>$post->id])->first())
									class = "fas fa-check upVotedCheck"
								 @endif ></span>
								<span class="fal fa-arrow-alt-up optionsIcons" id="postOptionsVoteUpIcon-{{$post->id}}" {{ Auth::user()->postsVotes()->where(["type"=>1,"to_type"=>"App\Post","to_id"=>$post->id])->first() ? "style=color:green;" : "" }}></span> 
								<span class="optionsText" id="postOptionsVoteUpText-{{$post->id}}" {{ Auth::user()->postsVotes()->where(["type"=>1,"to_type"=>"App\Post","to_id"=>$post->id])->first() ? "style=color:green;" : "" }}>
								{{ Auth::user()->postsVotes()->where(["type"=>1,"to_type"=>"App\Post","to_id"=>$post->id])->first() ? "Up-voted" : "Up-vote" }}</span> 
								. <span class="votes" id="postOptionsVoteUpCount-{{$post->id}}">{{$post->votedBy()->where("type",1)->count()}}</span>
							</a>
						</button>
						<button class="btn" onclick="vote('{{$post->id}}','voteDown')" title="The answer was not usefull">
							<a href="javascript:void(0)">
								<span id="downVotedCheck-{{$post->id}}" @if(Auth::user()->postsVotes()->where(["type"=>0,"to_type"=>"App\Post","to_id"=>$post->id])->first())
									class = "fas fa-check upVotedCheck"
								 @endif></span>
								<span class="fal fa-arrow-alt-down optionsIcons" id="postOptionsDownVoteUpIcon-{{$post->id}}" {{ Auth::user()->postsVotes()->where(["type"=>0,"to_type"=>"App\Post","to_id"=>$post->id])->first() ? "style=color:green;" : "" }}></span> 
								<span class="optionsText" id="postOptionsDownVoteText-{{$post->id}}" {{ Auth::user()->postsVotes()->where(["type"=>0,"to_type"=>"App\Post","to_id"=>$post->id])->first() ? "style=color:green;" : "" }}>{{ Auth::user()->postsVotes()->where(["type"=>0,"to_type"=>"App\Post","to_id"=>$post->id])->first() ? "Down-voted" : "Down-vote" }}</span>  
								. <span class="votes" id="postOptionsVoteDownCount-{{$post->id}}">{{$post->votedBy()->where("type",0)->count()}}</span>
							</a>
						</button>
						<button class="btn" title="Follow the post for lates update">
							<a href="#">
								<span class="fal fa-wifi optionsIcons"></span> 
								<span class="optionsText">Follow</span> 
								<span class="votes">. 2</span>
							</a>
						</button>
						@endauth
						<!-- End of the posts options that should be visible only for auth users -->

						<!-- Beggining of the posts options that should be visible only for gues users -->
						@guest
						<button class="btn postOptionsForGuest" title="The answer was usefull. You have to Login First">
							<a href="javascript:void(0)">
								<span class="far fa-arrow-alt-up optionsIcons"></span> 
								<span class="optionsText">Up-vote</span> 
								<span class="votes">. {{$post->votedBy()->where("type",1)->count()}}</span>
							</a>
						</button>
						<button class="btn postOptionsForGuest" title="The answer was not usefull. You have to Login First">
							<a href="javascript:void(0)">
								<span class="fal fa-arrow-alt-down optionsIcons"></span> 
								<span class="optionsText">Down-vote</span>  
								<span class="votes">. {{$post->votedBy()->where("type",0)->count()}}</span>
							</a>
						</button>
						<button class="btn postOptionsForGuest" title="Follow the post for lates update. You have to Login First">
							<a href="javascript:void(0)">
								<span class="fal fa-wifi optionsIcons"></span> 
								<span class="optionsText">Follow</span> 
								<span class="votes">. 2</span>
							</a>
						</button>
						@endguest
						<!-- End of the posts options that should be visible only for guest users -->

						<!-- Beggining of the posts options that should be visible for both the  auth users and guest users -->
						<button class="btn" title="All comments for this post" onclick="showAllComments({!!$post->id!!})">
							<a href="javascript::void(0)">								<span class="fal fa-comment optionsIcons"></span> 
								<span class="optionsText">comments</span> 
								<span class="votes">. {{count($post->comments)}}</span>
							</a>
						</button>
						<!-- End of the posts options that should be visible for both the  auth users and guest users -->

						@auth
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
						@endauth
					</div>

					<!--Begginning  comments part  -->
					<div id="commentPart" style="margin-bottom: 45px;position: relative;">
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
						@auth
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
										{!! Form::file("photo",["class"=>"commentPhotoField","accept"=>"image/*","id"=>"commentPhotoField-$post->id","onchange"=>"showAndValidateFile($post->id)"]) !!}
										<textarea  name="content" class="form-control commentField" placeholder="Add Comment to post..." id="commentField-{{$post->id}}" rows="1" maxlength="65500" 
										onkeyup="do_resize_and_enable_button(this,{!! $post->id !!})">@if(old("post_id") == $post->id) {{old("content")}} @endif</textarea>
										<input type="hidden" name="post_id" value= @if(old("post_id") == $post->id) {{old("post_id")}} @else {{$post->id}} @endif >
										{!! Form::submit("Add Comment",["class"=>"btn  btn-sm addCommentBtn","id"=>"addCommentBtn-$post->id","disabled"=>"true","onclick"=>"validateCommentForm($post->id)"]) !!}
										<i class="fal fa-camera commentPhotoButton" id="commentPhotoButton-$post->id" onclick="openCommentPhotoField({!!$post->id!!})"></i>
									</div>
								{!! Form::close() !!}
								<div class="dropdown-divider"></div>
							</div>
						@endauth
							<!-- Beggining of all comments part -->
							<div class="allComments" id="allComments-{{$post->id}}">
								@if(count($post->comments) > 0)
									<div class="mb-2 ml-2 comments-count">{{count($post->comments)}} Comments</div>
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
											
											@if($comment->content)
												@if(strlen($comment->content) > 500)
													<p id="halfComment-{{$comment->id}}">{{Str::limit($comment->content,500)}} <a href="javascript:void(0)" class="readMoreLess" onclick="showComplete({!! $comment->id !!},'comment')">Read more...</a></p>	
													<p id="completeComment-{{$comment->id}}" style="display: none;">{{$comment->content}} <a href="javascript:void(0)" class="readMoreLess" onclick="showLess({!! $comment->id !!},'comment')">Read less...</a></p>
												@else
													<p>{{ $comment->content }}</p>
												@endif
											@endif
											
											@if(count($comment->photos) > 0)
												<div id="commentImage" class="text-center" style="overflow: hidden;">
													<a href="/storage/images/comments/{{$comment->photos()->where('status',1)->first()->path}}" target="__blank">
														<img src="/storage/images/comments/{{$comment->photos()->where('status',1)->first()->path}}" class="">
														
													</a>
												</div>
											@endif
										</div>
										<!-- End of: all comments content part -->

										<!-- Beggining of: options for comments -->
										<div class="commetOptions">
											<button class="btn" title="Reply" onclick="showReplies({!! $comment->id !!})">
												@auth <a href="javascript:void(0)"> @endauth
													<span class="fal fa-reply commentOptionsIcons"></span>  
													<span class="commentVotes">. Reply.  {{count($comment->replies)}}</span>
												@auth </a> @endauth
											</button>
											<button class="btn" title="The answer was usefull">
												@auth <a href="#"> @endauth
													<span class="fal fa-arrow-alt-up commentOptionsIcons"></span> 
													<span class="commentVotes">. 2</span>
												@auth </a> @endauth
											</button>
											<button class="btn" title="The answer was not usefull">
												@auth <a href="#"> @endauth
													<span class="fal fa-arrow-alt-down commentOptionsIcons"></span>  
													<span class="commentVotes">. 2</span>
												@auth </a> @endauth
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
												@if(session("replyError"))
													{{ session("replyError") }}
												@endif
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
										@auth
											<div class ="reply" id="reply-{{$comment->id}}">
												{!! Form::open(["method"=>"post","action"=>"CommentReplyController@store","files"=>"true"]) !!}		
													<div class="input-group">
														{!! Form::file("replyPhoto",["class"=>"replyPhotoField","accept"=>"image/*","id"=>"replyPhotoField-$comment->id","onchange"=>"showAndValidateReplyFile($comment->id)"]) !!}
														<textarea  name="replyContent" class="form-control replyField" placeholder="Add Reply..." id="replyField-{{$comment->id}}" rows="1" maxlength="65500" 
														onkeyup="do_resize_and_enable_reply_button(this,{!! $comment->id !!})">@if(old("comment_id") == $comment->id) {{old("replyContent")}} @endif</textarea>
														<input type="hidden" name="comment_id" value= @if(old("comment_id") == $comment->id) {{old("comment_id")}} @else {{$comment->id}} @endif >
														<!-- This hidden field is responsible to take the post id with it because in return we need it to scrooll to all comments -->
														<input type="hidden" name="post_id_for_replies" value= @if(old("post_id") == $post->id) {{old("post_id_for_replies")}} @else {{$post->id}} @endif >
														{!! Form::submit("Reply",["class"=>"btn  btn-sm addReplyBtn","id"=>"addReplyBtn-$comment->id","disabled"=>"true","onclick"=>"validateReplyForm($comment->id)"]) !!}
														<i class="fal fa-camera replyPhotoButton" id="replyPhotoButton-{{$comment->id}}" onclick="openReplyPhotoField({!!$comment->id!!})"></i>
													</div>
												{!! Form::close() !!}
											</div>
										@endauth
										<!-- End of form for replies -->

										<!-- Beggining of: of the showing all replies for a comment -->
										<div class="allReplies" id="allReplies-{{$comment->id}}">
											<div class="dropdown-divider"></div>
											@if(count($comment->replies) > 0)
											<div class="mb-2 replies-count">{{count($comment->replies)}} Replies</div>
													@foreach($comment->replies as $reply)
														<!-- replied by image -->
														<div class="allRepliesOwnerImage">
															@if(count($reply->owner->photos) > 0)						
																@if($reply->owner->owner_type == "App\Doctor")
																	<img src="/storage/images/doctors/{{$reply->owner->photos()->where('status','1')->first()->path}}">
																@else
																	<img src="/storage/images/normalUsers/{{$reply->owner->photos()->where('status','1')->first()->path}}">
																@endif
															@else
																<span class="fal fa-user" id="no-image-in-reply"></span>
															@endif
															<div class="replyOwnerName">
																<a href="{{route('profile',$reply->owner->username)}}"><span>{{$reply->owner->owner->fullName}}</span></a> 
																@if($comment->created_at)
																	<span class="replyCreateTime">Replied:{{$reply->created_at->diffForHumans()}}</span>
																@endif
															</div>
														</div>
														<!-- End of replied by image  -->

														<!-- Beggining of : all replies content part -->
														<div class="allRepliessContent" id="allRepliessContent-{{$reply->id}}">
															@if($reply->content)
																@if(strlen($reply->content) > 300)
																	<p id="halfReply-{{$reply->id}}">{{Str::limit($reply->content,300)}} <a href="javascript:void(0)" class="readMoreLess" onclick="showComplete({!! $reply->id !!},'reply')">Read more...</a></p>	
																	<p id="completeReply-{{$reply->id}}" style="display: none;">{{$reply->content}} <a href="javascript:void(0)" class="readMoreLess" onclick="showLess({!! $reply->id !!},'reply')">Read less...</a></p>
																@else
																	<p>{{ $reply->content }}</p>
																@endif
															@endif
															
															@if(count($reply->photos) > 0)
																<div class="replyImage text-center" style="overflow: hidden;">
																	<a href="/storage/images/comment_replies/{{$reply->photos()->where('status',1)->first()->path}}" target="__blank">
																		<img src="/storage/images/comment_replies/{{$reply->photos()->where('status',1)->first()->path}}" class="">
																	</a>
																</div>
															@endif
														</div>
														<!-- End of: all replies content part -->

														<!-- Beggining of: options for comments -->
															<div class="commetOptions">
																<button class="btn" title="The answer was usefull">
																	@auth<a href="#">@endauth
																		<span class="fal fa-arrow-alt-up commentOptionsIcons"></span> 
																		<span class="commentVotes">. 2</span>
																	@auth</a>@endauth
																</button>
																<button class="btn" title="The answer was not usefull">
																	@auth<a href="#">@endauth
																		<span class="fal fa-arrow-alt-down commentOptionsIcons"></span>  
																		<span class="commentVotes">. 2</span>
																	@auth</a>@endauth
																</button>
															</div>
														<!-- End of :options for comments-->
														<div class="dropdown-divider reply-divider"></div>
													@endforeach
											@else
												<div class="no-comment">No Replies</div>
											@endif
										</div>
										<!-- End of: of the showing all replies for a comment -->
										<div class="dropdown-divider" id="dividerForComments"></div>
									@endforeach
								@else
									<span class="no-comment">No Comment</span>	
								@endif
							</div>
							<!-- End of : all comments content part -->
							
						
						<div class="clearfix"></div>
						<!-- End Showing all comments part  -->
					</div>
					<!-- End of comment part -->
			@endforeach
		@endif
	</div>
	<div id="achievements" class="tab-content" >
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


	@if(session('comment_id'))
		<script type="text/javascript">
			var scroll = "toReplySuccess";
			var comment_id = {!! json_encode(session('comment_id')) !!};
			var post_id = {!! json_encode(session('post_id')) !!};
		</script>
	@endif

	@if(session('replyError') || $errors->has("replyPhoto"))
		<script type="text/javascript">
			var scroll = "toReplyError";
			var comment_id = {!! json_encode(old("comment_id")) !!};
			var post_id = {!! json_encode(old("post_id_for_replies")) !!};
		</script>
	@endif


<!-- These variables are for ajax  token and route to which vote the post -->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';
		var postVote = '{{route("postVote")}}';
	</script>

@endsection