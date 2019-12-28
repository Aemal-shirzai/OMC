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
				Latest Questions
			@endif
			@isset($type) 
				@if($type == "top") 
					Top Questions 
				@elseif($type == "down")
					Less Voted Questions
				@elseif($type == "mostFollowed")
					Most Followed Questions
				@endif 
			@endisset 
		</h3>
	</div>
	<div id="searchFor">
		{!! Form::open(["method"=>"GET","action"=>"QuestionController@search","id"=>"searchForm"]) !!}
			<div style="position: relative;">
				{!! Form::text("searchFor",request()->input('searchFor'),["class"=>"form-control","id"=>"searchForField","placeholder"=>"search questions ","onkeyup"=>"searchQuestions()","autocomplete"=>"off","maxLength"=>"200"]) !!}
				<a href="javascript:void(0)" id="searchIcon" class="far fa-search" onclick="submitSearchForm()"></a>
			</div>
		{!! Form::close() !!}
		<div id="searchResult">
			<h6 id="searchInfo"><span id="searchText">results</span> <img src="{{asset('images/load1.gif')}}" id="searchLoad"></h6>
			<div id="allResultsDiv">
				
			</div>
		</div>
	</div>
	<div class="orderBy">
		<div class="orderByOptionParent float-right" style="">
			<a href="{{route('questions.index')}}" class="btn btn-sm ">
				@if(empty($type))<span class="fad fa-check"></span>@endif Latest
			</a>
			<a href="{{route('questionsSortBy','top')}}" class="btn btn-sm">
				@isset($type)@if($type == "top")<span class="fad fa-check"></span>@endif @endisset 
				Most Voted
			</a>
			<a href="{{route('questionsSortBy','down')}}" class="btn btn-sm ">
				@isset($type)@if($type == "down")<span class="fad fa-check"></span>@endif @endisset 
				Down Voted
			</a>
			<a href="{{route('questionsSortBy','mostFollowed')}}" class="btn btn-sm ">@isset($type)@if($type == "mostFollowed")<span class="fad fa-check"></span>@endif @endisset Most Followed
			</a>
		</div>

		<span class="float-right sortText">SortBy:</span>
	</div>
<!-- End of title and sortBy options -->
	<div class="clearfix"></div>

	@if(count($questions) > 0)
	@foreach($questions as $question)
		<div class="mainContent" id="mainContent-{{$question->id}}">
			<!-- owner information about post or questions -->
			<div class="ownerInfo" id="ownerInfo-{{$question->id}}">
					@if(count($question->owner->account->photos) > 0)
						<img src="/storage/images/normalUsers/{{$question->owner->account->photos()->where('status',1)->first()->path}}">
					@else
						<span class="fal fa-user" id="no-owner-image"></span>
					@endif
					<div id="ownerName">
						<a href="{{route('profile',$question->owner->account->username)}}"><span id="fullName">{{$question->owner->fullName}}</span> </a>
						@if($question->created_at)
							<span id="createTime">Asked:{{$question->created_at->diffForHumans()}}</span>
						@endif
					</div>
			</div>
			<!--End owner information about post or questions -->
			
			<!-- Beggingin of the content part -->
			<div id="content-{{$question->id}}" class="content col-12">
				<a href="{{route('questions.show',$question->id)}}"><h5 style="color: #3fbbc0">{{$question->title}}</h5></a>
				<div class="tags ">
					@if($question->tags()->count() > 0)
						@foreach($question->tags as $tag)
							<span><a href="#">{{$tag->category}}</a></span>
						@endforeach
					@endif
				</div>
				@if($question->content)
					<a href="{{route('questions.show',$question->id)}}" style="color: black;"><p>{{ Str::limit($question->content,300) }} <span class="readMoreLess" style="display: block;">View Full</span></a></p>
				@endif
			</div>
			<div class="clearfix"></div>
			<!-- End of the content part -->

			<!-- Beggining of opstions for posts -->
				<div class="options">
					<!-- Beggining of the posts options that should be visible only for auth users -->
					@auth
					<button class="btn OptionsForGuest" title="The answer was usefull">
						<a href="javascript:void(0)">
							<span id="upVotedCheck-{{$question->id}}" @if(Auth::user()->questionsVotes()->where(["type"=>1,"to_type"=>"App\Question","to_id"=>$question->id])->first())
								class = "fas fa-check upVotedCheck"
							 @endif ></span>

							<span class="fal fa-arrow-alt-up optionsIcons" id="postOptionsVoteUpIcon-{{$question->id}}" {{ Auth::user()->questionsVotes()->where(["type"=>1,"to_type"=>"App\Question","to_id"=>$question->id])->first() ? "style=color:#3fbbc0;" : "" }}></span> 

							<span class="optionsText" id="postOptionsVoteUpText-{{$question->id}}" {{ Auth::user()->questionsVotes()->where(["type"=>1,"to_type"=>"App\Question","to_id"=>$question->id])->first() ? "style=color:#3fbbc0;" : "" }}>Up-votes</span>

							. <b><span class="votes" id="postOptionsVoteUpCount-{{$question->id}}">{{$question->votedBy()->where("type",1)->count()}}</span></b>
						</a>
					</button>
					<button class="btn OptionsForGuest" title="The answer was not usefull">
						<a href="javascript:void(0)">

							<span id="downVotedCheck-{{$question->id}}" @if(Auth::user()->questionsVotes()->where(["type"=>0,"to_type"=>"App\Question","to_id"=>$question->id])->first())
								class = "fas fa-check upVotedCheck"
							 @endif></span>

							<span class="fal fa-arrow-alt-down optionsIcons" id="postOptionsDownVoteUpIcon-{{$question->id}}" {{ Auth::user()->questionsVotes()->where(["type"=>0,"to_type"=>"App\Question","to_id"=>$question->id])->first() ? "style=color:#3fbbc0;" : "" }}></span> 

							<span class="optionsText" id="postOptionsDownVoteText-{{$question->id}}" {{ Auth::user()->questionsVotes()->where(["type"=>0,"to_type"=>"App\Question","to_id"=>$question->id])->first() ? "style=color:#3fbbc0;" : "" }}>Down-votes</span>  

							. <b><span class="votes" id="postOptionsVoteDownCount-{{$question->id}}">{{$question->votedBy()->where("type",0)->count()}}</span></b>
						</a>
					</button>
					@can("normalUser_related",Auth::user())
					<button class="btn {{ Auth::user()->owner->favoriteQuestions()->where(['fav_type'=>'App\Question','fav_id'=>$question->id])->first() ? 'followed' : '' }}" onclick="followQuestion('{{$question->id}}')" id="favoriteButton-{{$question->id}}" title="Follow the question for lates update">
						<a href="javascript:void(0)">
							<span class="fal fa-wifi optionsIcons"></span> 
							<span class="optionsText" id="followOptionText-{{$question->id}}">
								{{ Auth::user()->owner->favoriteQuestions()->where(['fav_type'=>'App\Question','fav_id'=>$question->id])->first() ? 'Un-follow' : 'Follow' }}
							</span> 
							. <b><span class="votes" id="favoritesPostCount-{{$question->id}}"> {{$question->favoritedBy()->count()}}</span></b>
						</a>
					</button>
					@endcan
					@can("Doctor_related",Auth::user())
					<button class="btn OptionsForGuest" title="Follow the post for lates update">
						<a href="javascript:void(0)">
							<span class="fal fa-wifi optionsIcons"></span> 
							<span class="optionsText">Followers</span> 
							<b><span class="votes">. {{$question->favoritedBy()->count()}}</span></b>
						</a>
					</button>
					@endcan
					<div class="confirmationBox" id="questionConfirmationBox-{{$question->id}}">
						<div id="text">Are You Sure To Delete?</div>
						<div id="text"><small>Remember: There is no comeback</small></div>
						<a href="javascript:void(0)" onclick="deleteQuestions('{{$question->id}}')" class="btn btn-danger btn-sm">Remove</a>
						<a href="javascript:void(0)" onclick="QuestionClosePermissionBox('{{$question->id}}')" class="btn btn-light btn-sm">Cancel</a>
					</div>
					@endauth
					<!-- End of the posts options that should be visible only for auth users -->

					<!-- Beggining of the posts options that should be visible only for gues users -->
					@guest
					<button class="btn OptionsForGuest" title="The answer was usefull. You have to Login First">
						<a href="javascript:void(0)">
							<span class="far fa-arrow-alt-up optionsIcons"></span> 
							<span class="optionsText">Up-votes</span> 
							<b><span class="votes">. {{$question->votedBy()->where("type",1)->count()}}</span></b>
						</a>
					</button>
					<button class="btn OptionsForGuest" title="The answer was not usefull. You have to Login First">
						<a href="javascript:void(0)">
							<span class="fal fa-arrow-alt-down optionsIcons"></span> 
							<span class="optionsText">Down-votes</span>  
							<b><span class="votes">. {{$question->votedBy()->where("type",0)->count()}}</span></b>
						</a>
					</button>
					<button class="btn OptionsForGuest" title="Follow the post for lates update. You have to Login First">
						<a href="javascript:void(0)">
							<span class="fal fa-wifi optionsIcons"></span> 
							<span class="optionsText">Followers</span> 
							<b><span class="votes">. {{$question->favoritedBy()->count()}}</span></b>
						</a>
					</button>
					@endguest
					<!-- End of the posts options that should be visible only for guest users -->

					<!-- Beggining of the posts options that should be visible for both the  auth users and guest users -->
					<button class="btn" title="All comments for this post">
						<a href="{{route('questions.show',$question->id)}}">	<span class="fal fa-comment optionsIcons"></span> 
							<span class="optionsText">All comments</span> 
							.<b><span class="votes" id="commentcounts1-{{$question->id}}"> {{count($question->comments)}}</span></b>
						</a>
					</button>
					<!-- End of the posts options that should be visible for both the  auth users and guest users -->

					<div class="btn float-right" id="shareBtn" title="All share options">
						<a href="#" onclick="openShareOptions({{$question->id}})">
							<span class="far fa-ellipsis-v optionsIcons"></span> 
						</a>
						<div class="shareOptions" id="shareOptions-{{$question->id}}">
							@auth
							@if(Auth::user()->id === $question->owner->account->id)
							<p class="text-center">Manage</p>
							<span title="Edit Post">
								<li>
									<a href="{{route('questions.edit',$question->id)}}" class="PostEditDelete"><span class="fas fa-edit"></span> Edit</a>
								</li>
							</span>
							@endif
							@if(Auth::user()->id === $question->owner->account->id || (Auth::user()->owner_type == "App\NormalUser" && Auth::user()->owner->role->role == "admin"))
							<span title="Delete Post">
								<li>
									<a href="javascript:void(0)" id="postDeleteOption-{{$question->id}}" class="PostEditDelete" onclick="openQuestionConfirmation('{{$question->id}}')"><span class="fas fa-trash"></span> <Span id="postDeleteText-{{$question->id}}">Delete</Span></a>
								</li>
							</span>
							@endif
							@endauth
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
				</div>
				
			<!-- End of opstions for posts -->
		</div>
	@endforeach
	{{ $questions->links() }}
	@else
	<h4>No Question found to display!</h4>
	@endif
</div>


@section("scripts")

<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';

		// This route is to add qiestion to favorite
		var questionFavorites = '{{route("questionFavorites")}}';

		// This route is to add and remove doctors to follow by normal user
		var DoctorFollow = '{{route("DoctorFollow")}}';

		// This route is delete the post by post owner
		var deleteQuestion = '{{route("deleteQuestion")}}';


		// retrive search result using ajax
		var questionsSearchResult = '{{route("searchResults.questions")}}';
	</script>

@endsection

@endsection