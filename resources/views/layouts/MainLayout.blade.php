<!DOCTYPE html>	
<html>
<head>
	<title>@yield("title")</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
	<!-- Link to bootstap app.css -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

	<!-- Link to local css file -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/MainLayoutStyle1.css')}}">
	
	@if(Route::currentRouteName() == 'main')
	<!-- Link to local mian css file -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/main1.css')}}">
	
	@elseif(Route::currentRouteName() == 'profile')
	<!-- Link to local profile style for profile page -->
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/profileStyle.css')}}">
	
	@elseif(Route::currentRouteName() == 'posts.create' || Route::currentRouteName() == 'questions.create' || Route::currentRouteName() == 'posts.edit' || Route::currentRouteName() == 'questions.edit' || Route::currentRouteName() == 'comments.edit' || Route::currentRouteName() == 'replies.edit')
	<!-- Link to local  style for posts add page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/postsAndQuestionsStyle11.css')}}">
	@elseif(Route::currentRouteName() == 'posts.index' || Route::currentRouteName() == 'questionsSortBy' || Route::currentRouteName() == 'postsSortBy' || Route::currentRouteName() == 'questions.index')
	<!-- Link to local styles for posts list page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/postsAndQuestionsListStyle1.css')}}">

	@elseif(Route::currentRouteName() == 'posts.show' || Route::currentRouteName() == 'questions.show')
	<!-- Link to local styles for posts list page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/postsAndQuestionsSingleStyle1.css')}}">

	@elseif(Route::currentRouteName() == 'doctors.index' || Route::currentRouteName() == 'nusers.index' || Route::currentRouteName() == 'doctorsSortBy' || Route::currentRouteName() == 'nusersSortBy')
	<!-- Link to local styles for doctors and normal users list page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/usersStyle.css')}}">
	@endif
	
	<!-- owl carousel plugin -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/owlCarousel/owl.carousel.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/owlCarousel/owl.theme.default.min.css')}}">

	<!-- link to animate.css -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/cssAnimate/animate.min.css')}}">
	<!-- Linkt to fontawesome  -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css')}}">	

</head>
<body>
<div class="sidebar-small" id="side"> <!-- navbar for small screen div start  -->
	<div id="sidebar-small-child-div">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		@auth
			<div class="text-center">
				<p>Signed in as</p>
				<span class="fal fa-user-circle" style="font-size: 20px;"></span>
				<a href="{{route('profile',Auth::user()->username)}}" style="padding-left: 0;">{{Auth::user()->username}}</a>
			</div>
		@endauth
		<div class="dropdown-divider"></div>
		<a href="{{route('main')}}" @if(Route::currentRouteName() == 'main')class="active" @endif><span class="fal fa-home"></span> Home</a>
		<a href="{{route('posts.index')}}" @if(Route::currentRouteName() == 'posts.index' || Route::currentRouteName() == 'postsSortBy')class="active" @endif><span class="fal fa-th"></span> Posts</a>
		<a href="{{route('questions.index')}}" @if(Route::currentRouteName() == 'questions.index' || Route::currentRouteName() == 'questionsSortBy')class="active" @endif><span class="fal fa-th"></span> Questions</a>
		<a href="{{route('doctors.index')}}" @if(Route::currentRouteName() == 'doctors.index')class="active" @endif><span class="fal fa-user-md"></span> Doctors</a>
		<a href="#"><span class="fal fa-tags"></span> Tags</a>
		<a href="javascript:void(0)" class="contactUs"><span class="fal fa-envelope"></span> Contact Us</a>
		@guest
			<a href="{{route('login')}}"><span class="fal fa-sign-in-alt"></span> Sign In</a>
			<a href="{{route('register')}}"><span class="fal fa-plus"></span> Sign Up</a>
		@endguest
		@auth
			<div class="dropdown-divider"></div>
			<a href="{{route('profile',Auth::user()->username)}}" class="fal fa-user smallMenuLogin"> Your profile</a>
			<a href="#" class="fal fa-user-cog smallMenuLogin"> Settings</a>
			<a href="" class="fal fa-lock smallMenuLogin"> Privacy & policy</a>
			<a href="" class="fal fa-question-circle smallMenuLogin"> Help</a>
			<a href="#" onclick="document.getElementById('logoutForm').submit();event.preventDefault();" class="fal fa-sign-out-alt smallMenuLogin"> Sign out</a>
		@endauth
	</div>
</div><!-- navbar for small screen div end  -->

<div id="parent-div"><!-- parent Div start-->
	
	<div class="col-12 text-right" id="header-div"> <!-- header div start -->

		<div id="header-div-content"> <!-- header-content div start -->
			<span class="float-left" id="timeAndDate">{{ Carbon\Carbon::now("Asia/kabul") }}</span>
			<a href="#" class="far fa-search @auth search-icon1 @endauth " id="search-icon"></a>&nbsp;
			@auth
			@can("Doctor_related",Auth::user())
				<a href="{{route('posts.create')}}" class ="AddPostAskQuestionSmall btn btn-sm" id="addPost">Add Post</a>
			@endcan
			@can("normalUser_related",Auth::user())
				<a href="{{route('questions.create')}}" class ="AddPostAskQuestionSmall btn btn-sm" id="addQustion">Ask Question</a>
			@endcan
		@endauth
			@auth
				<a href="#" onclick="document.getElementById('logoutForm').submit();event.preventDefault()" id="signout" class="login-register">Sign Out</a>
				{!! Form::open(["method"=>"POST","action"=>"Auth\LoginController@logout","id"=>"logoutForm"]) !!}
				{!! Form::close() !!}
			@endauth
			
			@guest
				<a href="{{route('login')}}" class="login-register">Login</a>
				<a href="{{route('register')}}" class="login-register">Register</a>
			@endguest
		</div> <!-- header-content div end -->

	</div><!-- header div end -->

	<div id="search-box-div"> <!-- search box div start -->
		{!! Form::open([]) !!}
			<div class="d-flex">
				<div class="btn btn-light search-box-button" id="search-close-button"><i class="far fa-arrow-left"></i></div>
				{!! Form::text("search",null,["class"=>"form-control  form-control-lg search-box-button","placeholder"=>"Search here ...","id"=>"search-box"]) !!}
			</div>
		{!! Form::close() !!}
	</div> <!-- search box div end -->

	<div id="sidebar-large" style=""> <!-- navbar for large screen div start  -->
		<div class="container">
		<div id="logodiv" style="" class="float-left">
		<a href="{{route('main')}}"><img src="{{asset('images/logo3.png')}}" class="img-fluid"></a>
		</div>
		<a href="javascript:void(0)" class="btn btn-light btn-sm openbtn" onclick="openNav()"><i class="far fa-bars"></i></a>
		@auth
		<div class="float-right" id="userProfileParent">
			<a href="javascript:void(0)" id="userProfileIcon" @if(Route::currentRouteName() == 'profile') class='active'  @endif>
				<i class="fal fa-user-circle"></i>
					
				<span class="far fa-caret-down"></span>
			</a>
			<div id="dropdownContent">
				Signed in as
				<a href="#"><b>{{Auth::user()->username}}</b></a>
				<div class="dropdown-divider"></div>
				<a href="{{route('profile',Auth::user()->username)}}" class="fal fa-user"> Your profile</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="fal fa-user-cog"> Settings</a>
				<div class="dropdown-divider"></div>
				<a href="" class="fal fa-lock"> Privacy & policy</a>
				<div class="dropdown-divider"></div>
				<a href="" class="fal fa-question-circle"> Help</a>
				<div class="dropdown-divider"></div>
				<a href="#" onclick="document.getElementById('logoutForm').submit();event.preventDefault();" class="fal fa-sign-out-alt"> Sign out</a>
			</div>
		</div>	
		<!-- Beggining of: Notifications part -->
		<div class="float-right" id="userNotificationsParent">
			<a href="javascript:void(0)" id="userNotificationIcon" @if(Route::currentRouteName() == 'profile') class='active'  @endif>
				<sup><span class="badge badge-danger" id="notificationBadge">{{Auth::user()->unreadnotifications()->count()}}</span></sup>
				<i class="fal fa-bell"></i>			
				<span class="far fa-caret-down"></span>
				&nbsp;
			</a>
			<div id="dropdownContentNotifications">
				@if(Auth::user(Auth::user()->notifications()->count() > 0))
					@foreach(Auth::user()->notifications as $notification)
					<div id="notification-{{$notification->id}}" class="{{$notification->read_at == '' ? 'notRead' : ''}}" style="position: relative;">
						@if($notification->type == "App\Notifications\commentToPosts")
							<a href="{{route('posts.show',$notification->data['post'])}}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
						@elseif($notification->type == "App\Notifications\commentForQuestion")
							<a href="{{route('questions.show',$notification->data['question'])}}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
						@elseif($notification->data['type'] == "follow")
							<a href="{{route('profile',$notification->data['byUsername'])}}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
						@elseif($notification->data['type'] == "reply")
							@if($notification->data["toType"] == 'App\Post')
								<a href="{{route('posts.show',$notification->data['toId'])}}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
							@else
								<a href="{{route('questions.show',$notification->data['toId'])}}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
							@endif
						@endif
								<div  class="QownerInfo">
									
										@if($notification->data['byPhoto'])
											@if($notification->data['byAccount'] == 'App\NormalUser')
												<img src="/storage/images/normalUsers/{{$notification->data['byPhoto']}}" class="notification-img">
											@else
												<img src="/storage/images/doctors/{{$notification->data['byPhoto']}}" class="notification-img">
											@endif
										@else
											<span class="fad fa-user-circle" id="no-owner-image-notification"></span>
										@endif
										<div class="QownerName">
											<span class="QfullName">{{$notification->data["by"]}}</span> 
										</div>
									
								</div> 

								 <div class="messageN">{{$notification->data['message']}}</div>
							 	@if($notification->created_at)
									<span class="QcreateTime">{{$notification->created_at->diffForHumans()}}</span>
								@endif
								@if($notification->read_at == '')
									<span class="badge badge-danger" id="newOrNot">New</span>
								@endif
							</a>
						<div class="dropdown-divider" style="margin:1px;"></div>
					</div>
					@endforeach
				@else
					No Notifications! 
				@endif

			</div>
			<!-- End of drop down for notifications -->
		</div>	
		<!-- End of: Notifications part -->
		@endauth
		<a href="javascript:void(0)" class="contactUs">Contact Us</a>
		<a href="#">Tags</a>
		<a href="{{route('doctors.index')}}" @if(Route::currentRouteName() == 'doctors.index')class="active" @endif></span> Doctors</a>
		<a href="{{route('questions.index')}}" @if(Route::currentRouteName() == 'questions.index' || Route::currentRouteName() == 'questionsSortBy')class="active" @endif> Questions</a>
		<a href="{{route('posts.index')}}" @if(Route::currentRouteName() == 'posts.index' || Route::currentRouteName() == 'postsSortBy')class="active" @endif>Posts</a>
		<a href="{{route('main')}}" @if(Route::currentRouteName() == 'main')class="active" @endif>Home</a>
		</div>
	</div>
<!-- navbar for large screen div end  -->


<div id="mainParent">
	@guest
		<div class="alert alert-info" id="loginAlert"><a href="{{route('login')}}">Login</a> to add questions, comments, upvote and downvote posts and questions</div>
	@endguest
	@auth
		@if(Auth::user()->owner_type == "App\Doctor" && Auth::user()->owner->status == 0)
			@if(Auth::user()->owner->gender == 0)
				<div class="alert alert-info" id="loginAlert">
					Mr. {{Auth::user()->owner->fullName}}, Your account has been created and your will be contacted soon for confirmation through email or call. 
				</div>
			@else
				 <div class="alert alert-info" id="loginAlert">
					Mrs./Miss. {{Auth::user()->owner->fullName}}, Your account has been created and your will be contacted soon for confirmation through email or call.
				</div>
			@endif
		@endif
	@endauth
     
    <a href="javascript:void(0)" title="Go to top" id="topButton" onclick="goToTop()" class="btn btn-sm" style=""><b>Top</b></a> 

	@yield("content")

</div>

<!-- footer div start -->
<div id="footer" class="col-12">
	<div class="container" id="footer-content">
		<div class="row" >
			<div class="col-lg-3 col-sm-3" id="omc">
				<h5>omc</h5>
				<a href="#">About OMC</a>
				<a href="#">About Developers</a>
				<a href="#">Contact Us</a>
				<a href="#">Privacy and Policy</a>
			</div>
			<div class="col-lg-3 col-sm-3" id="general">
				<h5>General</h5>
				<a href="#">Quesions</a>
				<a href="#">Addvertisements</a>
				<a href="#">Jobs</a>
			</div>
			<div class="col-lg-3 col-sm-3" id="omc-network">
				<h5>omc network</h5>
				<a href="#">Doctors <span class="badge badge-secondary">{{App\Doctor::all()->count()}}</span></a>
				<a href="{{route('nusers.index')}}">Users <span class="badge badge-secondary">{{App\NormalUser::all()->count()}}</span></a>
				<a href="#">Tags <span class="badge badge-secondary">{{App\DiseaseCategory::all()->count()}}</span></a>
			</div>
			<div class="col-lg-3 col-sm-3" id="social-links">
				<h5>Follow us</h5>
				<a href="#" class="fab fa-facebook"></a>
				<a href="#" class="fab fa-twitter"></a>
				<a href="#" class="fab fa-linkedin"></a>
				<a href="#" class="fab fa-github"></a>
			</div>
		</div>
	</div>
</div>
<!-- Footer div end -->




</div><!-- Parent Div End -->
<!-- link to boootstrap app.js -->
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

<!-- owl carousel plugin -->
<script type="text/javascript" src="{{asset('js/owlCarousel/owl.carousel.min.js')}}"></script>

<!-- laravel social media share package link -->
<script src="{{ asset('js/share.js') }}"></script>

<!-- link to local js file -->
<script type="text/javascript" src="{{asset('js/MainLayoutScript.js')}}"></script>



@if(Route::currentRouteName() == 'profile')
<!-- link to local js file for profile page -->
<script type="text/javascript" src="{{asset('js/profileScript.js')}}"></script>

@elseif(Route::currentRouteName() == 'posts.create' || Route::currentRouteName() == 'questions.create' || Route::currentRouteName() == 'posts.edit' || Route::currentRouteName() == 'questions.edit' ||  Route::currentRouteName() == 'comments.edit' || Route::currentRouteName() == 'replies.edit')
<!-- Link to local  js for posts page -->
<script type="text/javascript" src="{{asset('js/postsAndQuestionsScripts1212.js')}}"></script>
@elseif(Route::currentRouteName() == 'posts.index' || Route::currentRouteName() == 'postsSortBy' || Route::currentRouteName() == 'questionsSortBy' || Route::currentRouteName() == 'questions.index')
<!-- Link to local  js for posts page -->
<script type="text/javascript" src="{{asset('js/postsAndQuestionsListScripts.js')}}"></script>
@elseif(Route::currentRouteName() == 'posts.show' || Route::currentRouteName() == 'questions.show')
<!-- Link to local  js for singl posts and questions page -->
<script type="text/javascript" src="{{asset('js/postsAndQuestionsSingleScripts333.js')}}"></script>

@elseif(Route::currentRouteName() == 'doctors.index' || Route::currentRouteName() == 'nusers.index' || Route::currentRouteName() == 'doctorsSortBy' || Route::currentRouteName() == 'nusersSortBy')
<!-- Link to local js for doctors and normal users list page -->
<script type="text/javascript" src="{{asset('js/usersScript1.js')}}"></script>
@endif

<script type="text/javascript">
	var token = '{{ Session::token() }}';
	var readMark = '{{route("readMark")}}';

</script>

@yield("scripts")

</body>
</html>