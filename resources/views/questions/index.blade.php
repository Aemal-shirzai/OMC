@extends("../layouts.MainLayout")

@section("title", "OMC All Questions")

@section("content")

<div class="container" id="listParent">
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
								<span class="followedBy">Followed By {{$mostVotedDoctor->followed()->count()}}</span>
								
								@can("view",Auth::user())
								<a href="javascript:void(0)" class="btn btn-sm float-right followingButtonAll" class="" id="followingButtonAll" onclick="followDoctor('{{$mostVotedDoctor->id}}','All')">
									<i class="{{ Auth::user()->owner->following()->where('doctors.id',$mostVotedDoctor->id)->first() ? 'fad fa-check' : 'fad fa-plus' }}" id="followButtonAllIcon-{{$mostVotedDoctor->id}}"></i>
									<span class="followingButtonTextAll" id="followingButtonTextAll-{{$mostVotedDoctor->id}}">
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


	@if(count($questions) > 0)
	@foreach($questions as $question)
		<div class="mainContent" id="mainContent-{{$question->id}}">
			<!-- owner information about post or questions -->
			<div class="ownerInfo" id="ownerInfo-{{$question->id}}">
				<a href="{{route('profile',$question->owner->account->username)}}">
					@if(count($question->owner->account->photos) > 0)
						<img src="/storage/images/normalUsers/{{$question->owner->account->photos()->where('status',1)->first()->path}}">
					@else
						<span class="fal fa-user" id="no-owner-image"></span>
					@endif
					<div id="ownerName">
						<span id="fullName">{{$question->owner->fullName}}</span> 
						@if($question->created_at)
							<span id="createTime">Asked:{{$question->created_at->diffForHumans()}}</span>
						@endif
					</div>
				</a>
			</div>
			<!--End owner information about post or questions -->
			
			<!-- Beggingin of the content part -->
			<div id="content-{{$question->id}}" class="content col-12">
				<h5>{{$question->title}}</h5>
				@guest
				<div class="btn float-right shareBtnForGuest" id="shareBtn" title="All share options">
					<a href="#" onclick="openShareOptions({{$question->id}})">
						<span class="far fa-ellipsis-h optionsIcons"></span> 
					</a>
					<div class="shareOptions shareOptionsForGuest" id="shareOptions-{{$question->id}}">
						<p class="text-center">Share</p>
						<!-- <a href="" class="fab fa-facebook"> Facebook</a> -->
						{!! Share::page(route('questions.show',$question->id),null,['class'=>'share','id'=>"share-facebook"],"<span>","</span>")->facebook() !!}
						<div class="dropdown-divider"></div>
						{!! Share::page(route('questions.show',$question->id),null,['class'=>'share','id'=>"share-twitter"],"<span>","</span>")->twitter() !!}
						<div class="dropdown-divider"></div>
						{!! Share::page(route('questions.show',$question->id),null,['class'=>'share','id'=>"share-linkedIn"],"<span>","</span>")->linkedin() !!}
						<div class="dropdown-divider"></div>
						{!! Share::page(route('questions.show',$question->id),null,['class'=>'share','id'=>"share-whatsapp"],"<span>","</span>")->whatsapp() !!}
						<div class="dropdown-divider"></div>
						{!! Share::page(route('questions.show',$question->id),null,['class'=>'share','id'=>"share-telegram"],"<span>","</span>")->telegram() !!}
					</div>
				</div>
				@endguest
				@if($question->photos()->count() > 0)
				<div class="contentImage text-center">
					<img src="/storage/images/questions/{{$question->photos()->where('status',1)->first()->path}}" class="">
				</div>
				@endif
				<div class="tags @if($question->photos()->count() > 0 )text-center @endif">
					@if($question->tags()->count() > 0)
						@foreach($question->tags as $tag)
							<span><a href="#">{{$tag->category}}</a></span>
						@endforeach
					@endif
				</div>
				@if($question->content)
					@if(strlen($question->content) > 1000)
						<p id="halfContent-{{$question->id}}">
							{{ Str::limit($question->content,1000)}} 
							<a href="javascript:void(0)" class="readMoreLess" onclick="showComplete({!! $question->id !!},'post')">Read More...</a>
						</p>
						<p id="completeContent-{{$question->id}}" style="display: none;">
							{{ $question->content}}
							<a href="javascript:void(0)" class="readMoreLess" onclick="showLess({!! $question->id !!},'post')">Read Less...</a>
						</p>
					@else
						<p>{{ $question->content }}</p>
					@endif
				@endif
			</div>
			<div class="clearfix"></div>
			<!-- End of the content part -->

			<!-- Beggining of opstions for posts -->
				<div class="options">
					<!-- Beggining of the posts options that should be visible only for auth users -->
					@auth
					<button class="btn" onclick="voteQuestion('{{$question->id}}','upVote')" title="The answer was usefull">
						<a href="javascript:void(0)">
							<span id="upVotedCheck-{{$question->id}}" @if(Auth::user()->questionsVotes()->where(["type"=>1,"to_type"=>"App\Question","to_id"=>$question->id])->first())
								class = "fas fa-check upVotedCheck"
							 @endif ></span>

							<span class="fal fa-arrow-alt-up optionsIcons" id="postOptionsVoteUpIcon-{{$question->id}}" {{ Auth::user()->questionsVotes()->where(["type"=>1,"to_type"=>"App\Question","to_id"=>$question->id])->first() ? "style=color:#3fbbc0;" : "" }}></span> 

							<span class="optionsText" id="postOptionsVoteUpText-{{$question->id}}" {{ Auth::user()->questionsVotes()->where(["type"=>1,"to_type"=>"App\Question","to_id"=>$question->id])->first() ? "style=color:#3fbbc0;" : "" }}>
							{{ Auth::user()->questionsVotes()->where(["type"=>1,"to_type"=>"App\Question","to_id"=>$question->id])->first() ? "Up-voted" : "Up-vote" }}</span>

							. <span class="votes" id="postOptionsVoteUpCount-{{$question->id}}">{{$question->votedBy()->where("type",1)->count()}}</span>
						</a>
					</button>
					<button class="btn" onclick="voteQuestion('{{$question->id}}','voteDown')" title="The answer was not usefull">
						<a href="javascript:void(0)">

							<span id="downVotedCheck-{{$question->id}}" @if(Auth::user()->questionsVotes()->where(["type"=>0,"to_type"=>"App\Question","to_id"=>$question->id])->first())
								class = "fas fa-check upVotedCheck"
							 @endif></span>

							<span class="fal fa-arrow-alt-down optionsIcons" id="postOptionsDownVoteUpIcon-{{$question->id}}" {{ Auth::user()->questionsVotes()->where(["type"=>0,"to_type"=>"App\Question","to_id"=>$question->id])->first() ? "style=color:#3fbbc0;" : "" }}></span> 

							<span class="optionsText" id="postOptionsDownVoteText-{{$question->id}}" {{ Auth::user()->questionsVotes()->where(["type"=>0,"to_type"=>"App\Question","to_id"=>$question->id])->first() ? "style=color:#3fbbc0;" : "" }}>{{ Auth::user()->questionsVotes()->where(["type"=>0,"to_type"=>"App\Question","to_id"=>$question->id])->first() ? "Down-voted" : "Down-vote" }}</span>  

							. <span class="votes" id="postOptionsVoteDownCount-{{$question->id}}">{{$question->votedBy()->where("type",0)->count()}}</span>
						</a>
					</button>
					@can("normalUser_related",Auth::user())
					<button class="btn {{ Auth::user()->owner->favoriteQuestions()->where(['fav_type'=>'App\Question','fav_id'=>$question->id])->first() ? 'followed' : '' }}" onclick="followQuestion('{{$question->id}}')" id="favoriteButton-{{$question->id}}" title="Follow the question for lates update">
						<a href="javascript:void(0)">
							<span class="fal fa-wifi optionsIcons"></span> 
							<span class="optionsText" id="followOptionText-{{$question->id}}">
								{{ Auth::user()->owner->favoriteQuestions()->where(['fav_type'=>'App\Question','fav_id'=>$question->id])->first() ? 'Un-follow' : 'Follow' }}
							</span> 
							. <span class="votes" id="favoritesPostCount-{{$question->id}}"> {{$question->favoritedBy()->count()}}</span>
						</a>
					</button>
					@endcan
					@can("Doctor_related",Auth::user())
					<button class="btn OptionsForGuest" title="Follow the post for lates update">
						<a href="javascript:void(0)">
							<span class="fal fa-wifi optionsIcons"></span> 
							<span class="optionsText">Followed by</span> 
							<span class="votes">. {{$question->favoritedBy()->count()}}</span>
						</a>
					</button>
					@endcan
					<div class="confirmationBox" id="postConfirmationBox-{{$question->id}}">
						<div id="text">Are You Sure To Delete?</div>
						<div id="text"><small>Remember: There is no comeback</small></div>
						<a href="javascript:void(0)" onclick="deleteQuestions('{{$question->id}}')" class="btn btn-danger btn-sm">Remove</a>
						<a href="javascript:void(0)" onclick="postClosePermissionBox('{{$question->id}}')" class="btn btn-light btn-sm">Cancel</a>
					</div>
					@endauth
					<!-- End of the posts options that should be visible only for auth users -->

					<!-- Beggining of the posts options that should be visible only for gues users -->
					@guest
					<button class="btn OptionsForGuest" title="The answer was usefull. You have to Login First">
						<a href="javascript:void(0)">
							<span class="far fa-arrow-alt-up optionsIcons"></span> 
							<span class="optionsText">Up-vote</span> 
							<span class="votes">. {{$question->votedBy()->where("type",1)->count()}}</span>
						</a>
					</button>
					<button class="btn OptionsForGuest" title="The answer was not usefull. You have to Login First">
						<a href="javascript:void(0)">
							<span class="fal fa-arrow-alt-down optionsIcons"></span> 
							<span class="optionsText">Down-vote</span>  
							<span class="votes">. {{$question->votedBy()->where("type",0)->count()}}</span>
						</a>
					</button>
					<button class="btn OptionsForGuest" title="Follow the post for lates update. You have to Login First">
						<a href="javascript:void(0)">
							<span class="fal fa-wifi optionsIcons"></span> 
							<span class="optionsText">Follow</span> 
							<span class="votes">. {{$question->favoritedBy()->count()}}</span>
						</a>
					</button>
					@endguest
					<!-- End of the posts options that should be visible only for guest users -->

					<!-- Beggining of the posts options that should be visible for both the  auth users and guest users -->
					<button class="btn" title="All comments for this post" onclick="showAllComments({!!$question->id!!})">
						<a href="javascript::void(0)">	<span class="fal fa-comment optionsIcons"></span> 
							<span class="optionsText">comments</span> 
							.<span class="votes" id="commentcounts1-{{$question->id}}"> {{count($question->comments)}}</span>
						</a>
					</button>
					<!-- End of the posts options that should be visible for both the  auth users and guest users -->

					@auth
					<div class="btn float-right" id="shareBtn" title="All share options">
						<a href="#" onclick="openShareOptions({{$question->id}})">
							<span class="far fa-ellipsis-v optionsIcons"></span> 
						</a>
						<div class="shareOptions" id="shareOptions-{{$question->id}}">
							
							@if(Auth::user()->id === $question->owner->account->id)
							<p class="text-center">Manage</p>
							<span title="Edit Post">
								<li>
									<a href="#" class="PostEditDelete"><span class="fas fa-edit"></span> Edit</a>
								</li>
							</span>
							<span title="Delete Post">
								<li>
									<a href="javascript:void(0)" id="postDeleteOption-{{$question->id}}" class="PostEditDelete" onclick="openPostConfirmation('{{$question->id}}')"><span class="fas fa-trash"></span> <Span id="postDeleteText-{{$question->id}}">Delete</Span></a>
								</li>
							</span>
							@endif
							<!-- <div class="dropdown-divider"></div> -->
							<p class="text-center">Share</p>
							{!! Share::page(route('questions.show',$question->id),null,['class'=>'share','id'=>"share-facebook"],"<span>","</span>")->facebook() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('questions.show',$question->id),null,['class'=>'share','id'=>"share-twitter"],"<span>","</span>")->twitter() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('questions.show',$question->id),null,['class'=>'share','id'=>"share-linkedIn"],"<span>","</span>")->linkedin() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('questions.show',$question->id),null,['class'=>'share','id'=>"share-whatsapp"],"<span>","</span>")->whatsapp() !!}
							<div class="dropdown-divider"></div>
							{!! Share::page(route('questions.show',$question->id),null,['class'=>'share','id'=>"share-telegram"],"<span>","</span>")->telegram() !!}
						</div>
					</div>
					@endauth
				</div>
				
			<!-- End of opstions for posts -->

			<!--////////////////////////////////  Begginning  comments part  ///////////////////////////////////////////////////////////////////  -->
			<div id="commentPart">
				<!-- Note: this div is used to show the error messages of both client side and serverside NOTE:ids names are confusing here -->

				<div class="alert alert-danger commentImageVideoErrorMsg" id="fileError-{{$question->id}}" >
					<button class="close" onclick="closeMsgs({!! $question->id !!})">&times;</button>
					<span id="msg-{{$question->id}}">
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
					<div class="alert alert-success commentSuccessMsgs" id="successMsg-{{$question->id}}">
						<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
							{{session('commentSuccess')}}
					</div>
				@endif
				<div class="commentImageDiv" id="commentImageDiv-{{$question->id}}" style="">
					<button class="close removeImage" onclick="removeImage({!! $question->id !!})" >
						&times; 
						<span class="removeEditCommentPhotoText"> Remove photo</span>
					</button>
					<a href="javascript:void(0)" class="fal fa-edit ml-2" onclick="openCommentPhotoField({!!$question->id!!})">
						<span class="removeEditCommentPhotoText">Change photo</span>
					</a>
					<div class="text-center" style="overflow: hidden;">
						<img src="" id="commentImg-{{$question->id}}" >
					</div>
				</div>
				@auth
					<!-- Beggining of div: The current authenticated user pic beside the comment form -->
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
					<!-- End of div: The current authenticated user pic beside the comment form -->

					<!-- Beggining of div: The form for adding comments -->
					<div id="comment">
						{!! Form::open(["method"=>"post","action"=>"CommentController@store","files"=>"true"]) !!}		
							<div class="input-group">
								{!! Form::file("photo",["class"=>"commentPhotoField","accept"=>"image/*","id"=>"commentPhotoField-$question->id","onchange"=>"showAndValidateFile($question->id)"]) !!}
								<textarea  name="content" class="form-control commentField" placeholder="Add Comment to post..." id="commentField-{{$question->id}}" rows="1" maxlength="65500" 
								onkeyup="do_resize_and_enable_button(this,{!! $question->id !!})">@if(old("question_id") == $question->id) {{old("content")}} @endif</textarea>
								<input type="hidden" name="question_id" value= @if(old("post_id") == $question->id) {{old("question_id")}} @else {{$question->id}} @endif >
								{!! Form::submit("Add Comment",["class"=>"btn  btn-sm addCommentBtn","id"=>"addCommentBtn-$question->id","disabled"=>"true","onclick"=>"validateCommentForm($question->id)"]) !!}
								<i class="fal fa-camera commentPhotoButton" id="commentPhotoButton-$question->id" onclick="openCommentPhotoField({!!$question->id!!})"></i>
							</div>
						{!! Form::close() !!}
					</div>
					<!-- End of div: The form for adding comments -->
				@endauth

				<!-- Beggining of all comments part -->
				<div class="allComments" id="allComments-{{$question->id}}">
					@if(count($question->comments) > 0)
						<b><div class="mb-2 ml-2 comments-count"><span id="commentsCount-{{$question->id}}">{{count($question->comments)}}</span> Comments</div></b>
						@foreach($question->comments as $comment)

							<!-- Beggining of: Image part of comment owner -->
							<div class="allcommentsOwnerImage" id="allcommentsOwnerImage-{{$comment->id}}">
								@if(count($comment->comment_owner->photos) > 0)							
									@if($comment->comment_owner->owner_type == "App\Doctor")
										<img src="/storage/images/doctors/{{$comment->comment_owner->photos()->where('status','1')->first()->path}}">
									@else
										<img src="/storage/images/normalUsers/{{$comment->comment_owner->photos()->where('status','1')->first()->path}}">
									@endif
								@else
									<span class="fal fa-user" id="no-image-in-comment"></span>
								@endif
								<!-- Comment owner name -->
								<div class="commentOwnerName">
									<a href="{{route('profile',$comment->comment_owner->username)}}"><span>{{$comment->comment_owner->owner->fullName}}</span></a> 
									@if($comment->created_at)
										<span class="commentcreateTime">Commented:{{$comment->created_at->diffForHumans()}}</span>
									@endif
								</div>
								<!-- End of comment owner name -->
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
								
								<!-- The image posted with comment  -->
								
								@if(count($comment->photos) > 0)
									<div id="commentImage" class="text-center" style="overflow: hidden;">
										<a href="/storage/images/comments/{{$comment->photos()->where('status',1)->first()->path}}" target="__blank">
											<img src="/storage/images/comments/{{$comment->photos()->where('status',1)->first()->path}}" class="">
											
										</a>
									</div>
								@endif
								<!--End of The image posted with comment  -->
							</div>
							<!-- End of: all comments content part -->

							<!-- Beggining of: options for comments -->
							<div class="commetOptions" id="commentOptions-{{$comment->id}}">
								<button class="btn" title="Reply" onclick="showReplies({!! $comment->id !!})">
									<a href="javascript:void(0)"> 
										<span class="fal fa-reply commentOptionsIcons"></span>  
										<span class="commentVotes">. Reply.  <span id="replies-count1-{{$comment->id}}">{{count($comment->replies)}}</span> </span>
									</a> 
								</button>
								@auth
								<button class="btn" onclick="voteComments('{{ $comment->id }}','upVote')" title="The answer was usefull">
									<a href="javascript:void(0)">
										<span id="commentVotedUpCheck-{{$comment->id}}" 
										@if(Auth::user()->commentsVotes()->where(["type"=>1,"votes.to_type"=>"App\Comment","votes.to_id"=>$comment->id])->first())
											class = "fas fa-check upVotedCheck"
										 @endif> </span>
										<span class="fal fa-arrow-alt-up commentOptionsIcons" id="commentOptionsVoteUpIcon-{{$comment->id}}" {{ Auth::user()->commentsVotes()->where(["type"=>1,"votes.to_type"=>"App\Comment","votes.to_id"=>$comment->id])->first() ? "style=color:#3fbbc0;" : "" }}></span> 
										<span id="commentOptionsLoadingUpText-{{$comment->id}}"></span>
										. <span class="commentVotes" id="commentOptionsVoteUpCount-{{$comment->id}}">{{$comment->votedBy()->where("type",1)->count()}}</span>
									</a>
								</button>
								<button class="btn" onclick="voteComments('{{ $comment->id }}','downVote')" title="The answer was not usefull">
									<a href="javascript:void(0)">
										<span id="commentVotedDownCheck-{{$comment->id}}" 
										@if(Auth::user()->commentsVotes()->where(["type"=>0,"votes.to_type"=>"App\Comment","votes.to_id"=>$comment->id])->first())
											class = "fas fa-check upVotedCheck"
										 @endif> </span>
										<span class="fal fa-arrow-alt-down commentOptionsIcons" id="commentOptionsVoteDownIcon-{{$comment->id}}" {{ Auth::user()->commentsVotes()->where(["type"=>0,"votes.to_type"=>"App\Comment","votes.to_id"=>$comment->id])->first() ? "style=color:#3fbbc0;" : "" }}></span>  
										<span id="commentOptionsLoadingDownText-{{$comment->id}}"></span>
										. <span class="commentVotes" id="commentOptionsVoteDownCount-{{$comment->id}}"> {{$comment->votedBy()->where("type",0)->count()}}</span>
									</a>
								</button>
								

								<!-- Beggining of: Comment managing options delete and update -->
								@if(Auth::user()->id === $comment->comment_owner->id)
								<button class=" commentManageOptions fal fa-edit float-right"> Edit</button>
								<button class="commentManageOptions fal fa-trash float-right" id="commentDeleteButton-{{$comment->id}}" onclick="deleteCommentPermission('{{$comment->id}}')"> Delete</button>
								@endif
								<!-- End of Comment managing options delete and update -->

								<div class="confirmationBox" id="commentConfirmationBox-{{$comment->id}}">
									<div id="text">Are You Sure You Want To Delete?</div>
									<div id="text"><small>Remember: There is no comeback</small></div>
									<a href="javascript:void(0)" onclick="deleteComments('{{$comment->id}}','{{$question->id}}')" class="btn btn-danger btn-sm">Delete</a>
									<a href="javascript:void(0)" onclick="closePermissionBox('{{$comment->id}}')" class="btn btn-light btn-sm">Cancel</a>
								</div>

								@endauth
								@guest
								<button class="btn OptionsForGuest" title="The answer was usefull. You need to login First">
									<a href="javascript:void(0)">
										<span class="fal fa-arrow-alt-up commentOptionsIcons"></span> 
										<span class="commentVotes">. {{$comment->votedBy()->where("type",1)->count()}}</span>
									</a>
								</button>
								<button class="btn OptionsForGuest" title="The answer was not usefull. You need to login First">
									<a href="javascript:void(0)">
										<span class="fal fa-arrow-alt-down commentOptionsIcons"></span>  
										<span class="commentVotes">. {{$comment->votedBy()->where("type",0)->count()}}</span>
									</a>
								</button>
								@endguest
								


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
											<input type="hidden" name="question_id_for_replies" value= @if(old("question_id") == $question->id) {{old("question_id_for_replies")}} @else {{$question->id}} @endif >
											{!! Form::submit("Reply",["class"=>"btn  btn-sm addReplyBtn","id"=>"addReplyBtn-$comment->id","disabled"=>"true","onclick"=>"validateReplyForm($comment->id)"]) !!}
											<i class="fal fa-camera replyPhotoButton" id="replyPhotoButton-{{$comment->id}}" onclick="openReplyPhotoField({!!$comment->id!!})"></i>
										</div>
									{!! Form::close() !!}
								</div>
							@endauth
							<!-- End of form for replies -->

							<!-- Beggining of: of the showing all replies for a comment -->
							<div class="allReplies" id="allReplies-{{$comment->id}}">
								@if(count($comment->replies) > 0)
								<b><div class="mb-2 replies-count"><span id="replies-count-{{$comment->id}}">{{count($comment->replies)}}</span> Replies</div></b>
										@foreach($comment->replies as $reply)
											<!-- replied by image -->
											<div class="allRepliesOwnerImage" id="replyOwnerInfo-{{$reply->id}}">
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
											<div class="commetOptions" id="repliesOptions-{{$reply->id}}">
												@auth
												<button class="btn" onclick="voteReplies('{{$reply->id}}','upVote')" title="The answer was usefull">
													<a href="javascript:void(0)">
														<span id="replyVotedUpCheck-{{$reply->id}}" 
														@if(Auth::user()->repliesVotes()->where(["type"=>1,"votes.to_type"=>"App\CommentReply","votes.to_id"=>$reply->id])->first())
															class = "fas fa-check upVotedCheck"
														 @endif> </span>
														<span class="fal fa-arrow-alt-up commentOptionsIcons" id="replyOptionsVoteUpIcon-{{$reply->id}}" {{ Auth::user()->repliesVotes()->where(["type"=>1,"votes.to_type"=>"App\CommentReply","votes.to_id"=>$reply->id])->first() ? "style=color:#3fbbc0;" : "" }}></span> 
														<span id="replyOptionsLoadingUpText-{{$reply->id}}"></span>
														<span class="commentVotes" id="replyOptionsVoteUpCount-{{$reply->id}}">{{$reply->votedBy()->where("type",1)->count()}}</span>
													</a>
												</button>
												<button class="btn" onclick="voteReplies('{{$reply->id}}','downVote')" title="The answer was not usefull">
													<a href="javascript:void(0)">
														<span id="replyVotedDownCheck-{{$reply->id}}" 
														@if(Auth::user()->repliesVotes()->where(["type"=>0,"votes.to_type"=>"App\CommentReply","votes.to_id"=>$reply->id])->first())
															class = "fas fa-check upVotedCheck"
														 @endif> </span>
														<span class="fal fa-arrow-alt-down commentOptionsIcons" id="replyOptionsVoteDownIcon-{{$reply->id}}" {{ Auth::user()->repliesVotes()->where(["type"=>0,"votes.to_type"=>"App\CommentReply","votes.to_id"=>$reply->id])->first() ? "style=color:#3fbbc0;" : "" }}></span>
														<span id="replyOptionsLoadingDownText-{{$reply->id}}"></span>  
														<span class="commentVotes" id="replyOptionsVoteDownCount-{{$reply->id}}">{{$reply->votedBy()->where("type",0)->count()}}</span>
													</a>
												</button>
												<!-- Beggining of: Comment managing options delete and update -->
													@if(Auth::user()->id === $reply->owner->id)
													<button class=" commentManageOptions fal fa-edit float-right"> Edit</button>
													<button class="commentManageOptions fal fa-trash float-right" id="deleteReplyButton-{{$reply->id}}" onclick="deleteReplyPermission('{{$reply->id}}')"> Delete</button>
													@endif
												<!-- End of Comment managing options delete and update -->

												<div class="confirmationBox" id="replyConfirmationBox-{{$reply->id}}">
													<div id="text">Are You Sure You Want To Delete?</div>
													<div id="text"><small>Remember: There is no comeback</small></div>
													<a href="javascript:void(0)" onclick="deleteReplies('{{$reply->id}}','{{$comment->id}}')" class="btn btn-danger btn-sm">Delete</a>
													<a href="javascript:void(0)" onclick="closeDeleteReplyPermission('{{$reply->id}}')" class="btn btn-light btn-sm">Cancel</a>
											</div>


												@endauth
												@guest
												<button class="btn OptionsForGuest" title="The answer was usefull">
													<a href="javascript:void(0)">
														<span class="fal fa-arrow-alt-up commentOptionsIcons"></span> 
														<span class="commentVotes">. {{$reply->votedBy()->where("type",1)->count()}}</span>
													</a>
												</button>
												<button class="btn btn OptionsForGuest" title="The answer was not usefull">
													<a href="javascript:void(0)">
														<span class="fal fa-arrow-alt-down commentOptionsIcons"></span>  
														<span class="commentVotes">. {{$reply->votedBy()->where("type",0)->count()}}</span>
													</a>
												</button>
												@endguest
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
			<div class="dropdown-divider col-10 mt-2 bg" id="divider"></div>
			<!-- ///////////////////////////////////////// End of comment part ////////////////////////////////////////////////////////////////-->
			
		</div>
	@endforeach
	@else
	<h4>No Question found to display!</h4>
	@endif
</div>


@section("scripts")
@if(session('question_id'))
		<script type="text/javascript">
			var scroll = "on";
			var toScrollToPostQuestion_id = {!! json_encode(session('question_id')) !!};
		</script>
	@endif
<!-- Error msgs of adding comment -->
	@error("photo")
		<script type="text/javascript">
			var scroll = "on1";
			var toScrollToPostQuestion_id = {!! json_encode(old("question_id")) !!};
		</script>
	@enderror


	@if(session('comment_id'))
		<script type="text/javascript">
			var scroll = "toReplySuccess";
			var comment_id = {!! json_encode(session('comment_id')) !!};
			var ToScrollTo_id = {!! json_encode(session('ToScrollTo_id')) !!};
		</script>
	@endif

	@if(session('replyError') || $errors->has("replyPhoto"))
		<script type="text/javascript">
			var scroll = "toReplyError";
			var comment_id = {!! json_encode(old("comment_id")) !!};
			var ToScrollTo_id = {!! json_encode(old("question_id_for_replies")) !!};
		</script>
	@endif

<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';
		var questionVote = '{{route("questionVote")}}';
		var commentVote = '{{route("commentVote")}}';
		var replyVote = '{{route("replyVote")}}';

		// This route is to add qiestion to favorite
		var questionFavorites = '{{route("questionFavorites")}}';

		// This route is to delete comments
		var deleteComment = '{{route("deleteComment")}}';

		// This route is to delete comments
		var deleteReply = '{{route("deleteReply")}}';

		// // This route is to add and remove doctors to follow by normal user
		// var DoctorFollow = '{{route("DoctorFollow")}}';

		// // This route is to rmove normalusers from follower list by doctors
		// var removeFollower = '{{route("removeFollower")}}';

		// This route is delete the post by post owner
		var deleteQuestion = '{{route("deleteQuestion")}}';
	</script>

@endsection

@endsection