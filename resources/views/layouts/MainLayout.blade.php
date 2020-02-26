<!DOCTYPE html>	
<html>
<head>
	<title>@yield("title")</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/png" href="{{asset('images/mainLogo.png')}}">

	<!-- Link to bootstap app.css -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

	<!-- Link to local css file -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/MainLayoutStyle.css')}}">	

	<!-- Link to local css file -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/adminLayout.css')}}">
	

	<link rel="stylesheet" type="text/css" href="{{asset('css/ErrorStyle.css')}}">
	@if(Route::currentRouteName() == 'main')
	<!-- Link to local mian css file -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/main1.css')}}">
	
	@elseif(Route::currentRouteName() == 'profile')
	<!-- Link to local profile style for profile page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/profileStyle.css')}}">

	@elseif(Route::currentRouteName() == 'posts.create' || Route::currentRouteName() == 'questions.create' || Route::currentRouteName() == 'posts.edit' || Route::currentRouteName() == 'questions.edit' || Route::currentRouteName() == 'comments.edit' || Route::currentRouteName() == 'replies.edit')
	<!-- Link to local  style for posts add page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/postsAndQuestionsStyle11.css')}}">
	@elseif(Route::currentRouteName() == 'posts.index' || Route::currentRouteName() == 'questionsSortBy' || Route::currentRouteName() == 'postsSortBy' || Route::currentRouteName() == 'questions.index' || Route::currentRouteName() == 'search.posts' || Route::currentRouteName() == 'search.questions')
	<!-- Link to local styles for posts list page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/postsAndQuestionsListStyle1.css')}}">

	@elseif(Route::currentRouteName() == 'posts.show' || Route::currentRouteName() == 'questions.show')
	<!-- Link to local styles for posts list page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/postsAndQuestionsSingleStyle1.css')}}">

	@elseif(Route::currentRouteName() == 'doctors.index' || Route::currentRouteName() == 'nusers.index' || Route::currentRouteName() == 'doctorsSortBy' || Route::currentRouteName() == 'nusersSortBy' || Route::currentRouteName() == 'search.doctors' || Route::currentRouteName() == 'search.nusers')
	<!-- Link to local styles for doctors and normal users list page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/usersStyle1.css')}}">	
	@elseif(Route::currentRouteName() == 'achEdit')
	<!-- Link to local styles for doctors and normal users list page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/achEditStyle11.css')}}">
	@elseif(Route::currentRouteName() == 'profile.edit')
	<!-- Link to local styles for doctors and normal users list page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/editUsers1.css')}}">	

	<!-- ADMIN PART -->
	@elseif(Route::currentRouteName() == 'dcategories.manage' || Route::currentRouteName() == 'tags.manage' || Route::currentRouteName() == 'roles.manage')
	<!-- Link to local styles for admin doctor categories -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/dcategories.css')}}">
	@elseif(Route::currentRouteName() == 'contact.manage' || Route::currentRouteName() == "admin.dashboard")
	<!-- Link to local styles for messaes-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/messages8.css')}}">
	@elseif(Route::currentRouteName() == 'ads.index')
	<!-- Link to local styles for admin advertisemnts-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/adds.css')}}">
	@elseif(Route::currentRouteName() == 'doctors.manage.index' || Route::currentRouteName() == 'admin.search.doctors' || Route::currentRouteName() == 'nusers.manage.index' || Route::currentRouteName() == "admin.search.nusers")
	<!-- Link to local styles for admin users-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/users.css')}}">
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
		<a href="{{route('nusers.index')}}"><span class="fal fa-tags"></span> Normal Users</a>
		<a @if(Route::currentRouteName() == 'main') href="javascript:void(0)" class="contactUs" @else href="{{route('contactus.index')}}" @endif><span class="fal fa-envelope"></span> Contact Us</a>
		@guest
			<a href="{{route('login')}}"><span class="fal fa-sign-in-alt"></span> Sign In</a>
			<a href="{{route('register')}}"><span class="fal fa-plus"></span> Sign Up</a>
		@endguest
		@auth
			<div class="dropdown-divider"></div>
			<a href="{{route('profile',Auth::user()->username)}}" class="fal fa-user smallMenuLogin"> Your profile</a>
			@can("normalUser_related",Auth::user())
				@can("admin_related",Auth::user())
					<a href="{{route('admin.dashboard')}}" class="fal fa-tachometer smallMenuLogin"> Dashboard</a>
				@endcan
			@endcan
			<a href="{{route('profile.edit',Auth::user()->username)}}" class="fal fa-user-cog smallMenuLogin"> Settings</a>
			<!-- <a href="" class="fal fa-lock smallMenuLogin"> Privacy & policy</a> -->
			<a href="{{route('contactus.index')}}" class="fal fa-question-circle smallMenuLogin"> Help</a>
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
		{!! Form::open(["method"=>"GET","action"=>"QuestionController@search","id"=>"searchForm1"]) !!}
			<div class="d-flex">
				<div class="btn btn-light search-box-button" id="search-close-button"><i class="far fa-arrow-left"></i></div>
				{!! Form::text("searchFor",null,["class"=>"form-control  form-control-lg search-box-button","placeholder"=>"Search here ...","id"=>"search-box1","onkeyup"=>"searchQuestions1()","autocomplete"=>"off"]) !!}
			</div>
		{!! Form::close() !!}
		<div id="searchResult1" >
			<h6 id="searchInfo1"><span id="searchText1">results</span> <img src="{{asset('images/load1.gif')}}" id="searchLoad1"></h6>
			<div id="allResultsDiv1">

			</div>
		</div>
	</div> <!-- search box div end -->

	<div id="sidebar-large" style=""> <!-- navbar for large screen div start  -->
		<div class="container">
		<div id="logodiv" style="" class="float-left" >
		<a href="{{route('main')}}"><img src="{{asset('images/mainLogo.png')}}" class="img-fluid" ></a>
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
				<a href="{{route('profile',Auth::user()->username)}}"><b>{{Auth::user()->username}}</b></a>
				<div class="dropdown-divider"></div>
				<a href="{{route('profile',Auth::user()->username)}}" class="fal fa-user"> Your profile</a>
				<div class="dropdown-divider"></div>
				@can("normalUser_related",Auth::user())
					@can("admin_related",Auth::user())
						<a href="{{route('admin.dashboard')}}" class="fal fa-tachometer smallMenuLogin"> Dashboard</a>
					@endcan
				@endcan
				<div class="dropdown-divider"></div>
				<a href="{{route('profile.edit',Auth::user()->username)}}" class="fal fa-user-cog smallMenuLogin"> Settings</a>
				<div class="dropdown-divider"></div>
				<a href="{{route('contactus.index')}}" class="fal fa-question-circle smallMenuLogin"> Help</a>
				<div class="dropdown-divider"></div>
				<a href="#" onclick="document.getElementById('logoutForm').submit();event.preventDefault();" class="fal fa-sign-out-alt"> Sign out</a>
			</div>
		</div>	
		<!-- Beggining of: Notifications part -->
		<div class="float-right" id="userNotificationsParent">
			<a href="javascript:void(0)" id="userNotificationIcon">
				@if(Auth::user()->unreadnotifications()->where("type","!=","App\Notifications\Admin\postAdd")->where("type","!=","App\Notifications\Admin\questionAdd")->where("type","!=","App\Notifications\Admin\userAdd")->count() > 0)
					<sup><span class="badge badge-danger" id="notificationBadge">{{Auth::user()->unreadnotifications()->count()}}</span></sup>
				@endif
				<i class="fal fa-bell"></i>			
				<span class="far fa-caret-down"></span>
				&nbsp;
			</a>
			<div id="dropdownContentNotifications">
				@if(Auth::user(Auth::user()->notifications()->count() > 0))
					@foreach(Auth::user()->notifications as $notification)
					<div id="notification-{{$notification->id}}" class="{{$notification->read_at == '' ? 'notRead' : ''}}" style="position: relative;">
						@if($notification->data['type'] != "admin.postAdd" && $notification->data['type'] != "admin.questionAdd" && $notification->data['type'] != "admin.userAdd" )
						@if($notification->type == "App\Notifications\commentToPosts")
							<a href="{{route('posts.show',$notification->data['post'])}}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
						@elseif($notification->type == "App\Notifications\commentForQuestion")
							<a href="{{route('questions.show',$notification->data['question'])}}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
						@elseif($notification->data['type'] == "follow")
							<a href="{{route('profile',\App\Account::find($notification->data['byId'])->username) }}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
						@elseif($notification->data['type'] == "reply")
							@if($notification->data["toType"] == 'App\Post')
								<a href="{{route('posts.show',$notification->data['toId'])}}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
							@else
								<a href="{{route('questions.show',$notification->data['toId'])}}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
							@endif
						@elseif($notification->data['type'] == "changeStatus")
							<a href="{{route('profile',Auth::user()->username)}}" id="notificationLink" onclick="markAsRead('{!! $notification->id !!}')">
						@endif
								<div  class="QownerInfo">
										@if($notification->data['type'] != "changeStatus")
										@if($notification->data['byPhoto'])
											@if($notification->data['byAccount'] == 'App\NormalUser')
												<img src="/storage/images/normalUsers/{{$notification->data['byPhoto']}}" class="notification-img">
											@else
												<img src="/storage/images/doctors/{{$notification->data['byPhoto']}}" class="notification-img">
											@endif
										@else
											<span class="fad fa-user-circle" id="no-owner-image-notification"></span>
										@endif
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
						@endif
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
		<a  @if(Route::currentRouteName() == 'main') href="javascript:void(0)" class="contactUs" @else href="{{route('contactus.index')}}" @endif> Contact Us</a>
		<a href="{{route('nusers.index')}}" @if(Route::currentRouteName() == 'nusers.index')class="active" @endif> Normal Users</a>
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
		@if(Auth::user()->owner->status == 0)
			@if(Auth::user()->owner->gender == 0)
				<div class="alert alert-info" id="loginAlert">
					Mr. {{Auth::user()->owner->fullName}}, Your account is deactivated for now, contact us for more inforamation. You may not be able to access some resources.
				</div>
			@else
				 <div class="alert alert-info" id="loginAlert">
					Mrs./Miss. {{Auth::user()->owner->fullName}}, Your account is deactivated for now, contact us for more inforamation. You may not be able to access some resources.	</div>
			@endif
		@endif
	@endauth
     
    <a href="javascript:void(0)" title="Go to top" id="topButton" onclick="goToTop()" class="btn btn-sm" style=""><b class="far fa-arrow-up"></b></a> 

<!-- to dispaly it using ajax if some one is not authorized for some of the resources -->
    <div id="notAllowedDiv">
    	<div id="notfound">
    		<button class="close" id="closeNotAllowed" onclick="closeMessage()"><span class="far fa-times"></span></button>
		<div class="notfound">
			@auth
			@if(Auth::user()->owner->status != 0)
				<h2><span id="notfoundCode">403</span> - Not Allowed</h2>
				<p>You do not have permission to access the document or program that you requested.</p>
			@else
				<h2>403 - Not Allowed<br> Your account is not active</h2>
				<p>You do not have permission to access the document or program that you requested.</p>
			@endif
			@endauth
			@guest
				<h2>403 - Not Allowed Need an account first</h2>
				<p>You do not have permission to access the document or program that you requested.</p>
			@endguest
	
		</div>
		</div>
    </div>

    <!-- Delete modal -->
	<div class="modal fade" id="deleteBox" tabindex="-1" role="dialog" aria-labelledby="deleteBoxTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header justify-content-center">
	        <h5 class="modal-title" id="deleteBoxTitle" style="font-weight: bold;"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <h3>Are you sure?</h3>
	        <small class="text-muted">Remember: There is no comeback.</small>
	      </div>
	      <div class="modal-footer" style="border-top: 0px;">
	        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
	        <button type="button" class="btn btn-danger btn-sm" id="DeleteButton">Delete</button>
	      </div>
	    </div>
	  </div>
	</div>


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
				<a @if(Route::currentRouteName() == 'main') href="javascript:void(0)" class="contactUs" @else href="{{route('contactus.index')}}" @endif>Contact Us</a>
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
				<a href="http://www.facebook.com" class="fab fa-facebook"></a>
				<a href="http://www.fa-twitter.com" class="fab fa-twitter"></a>
				<a href="http://www.fa-linkedin.com" class="fab fa-linkedin"></a>
				<a href="http://www.github.com" class="fab fa-github"></a>
			</div>
		</div>
	</div>
</div>
<!-- Footer div end -->




</div><!-- Parent Div End -->

<!-- link to  popper.js -->
<script type="text/javascript" src="{{asset('js/popper/popper.js')}}"></script>
<!-- link to boootstrap app.js -->
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

<!-- owl carousel plugin -->
<script type="text/javascript" src="{{asset('js/owlCarousel/owl.carousel.min.js')}}"></script>

<!-- laravel social media share package link -->
<script src="{{ asset('js/share.js') }}"></script>

<!-- link to local js file -->
<script type="text/javascript" src="{{asset('js/MainLayoutScript22.js')}}"></script>



@if(Route::currentRouteName() == 'profile')
<!-- link to local js file for profile page -->
<script type="text/javascript" src="{{asset('js/profileScript.js')}}"></script>
@elseif(Route::currentRouteName() == 'main')
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
@elseif(Route::currentRouteName() == 'posts.create' || Route::currentRouteName() == 'questions.create' || Route::currentRouteName() == 'posts.edit' || Route::currentRouteName() == 'questions.edit' ||  Route::currentRouteName() == 'comments.edit' || Route::currentRouteName() == 'replies.edit')
<!-- Link to local  js for posts page -->
<script type="text/javascript" src="{{asset('js/postsAndQuestionsScripts.js')}}"></script>
@elseif(Route::currentRouteName() == 'posts.index' || Route::currentRouteName() == 'postsSortBy' || Route::currentRouteName() == 'questionsSortBy' || Route::currentRouteName() == 'questions.index' || Route::currentRouteName() == 'search.posts' || Route::currentRouteName() == 'search.questions')
<!-- Link to local  js for posts page -->
<script type="text/javascript" src="{{asset('js/postsAndQuestionsListScripts11.js')}}"></script>
@elseif(Route::currentRouteName() == 'posts.show' || Route::currentRouteName() == 'questions.show')
<!-- Link to local  js for singl posts and questions page -->
<script type="text/javascript" src="{{asset('js/postsAndQuestionsSingleScripts.js')}}"></script>

@elseif(Route::currentRouteName() == 'doctors.index' || Route::currentRouteName() == 'nusers.index' || Route::currentRouteName() == 'doctorsSortBy' || Route::currentRouteName() == 'nusersSortBy' || Route::currentRouteName() == 'search.doctors' || Route::currentRouteName() == 'search.nusers')
<!-- Link to local js for doctors and normal users list page -->
<script type="text/javascript" src="{{asset('js/usersScript7.js')}}"></script>

@elseif(Route::currentRouteName() == 'achEdit')
<!-- Link to local js for doctors and normal users list page -->
<script type="text/javascript" src="{{asset('js/achEditScripts.js')}}"></script>

@elseif(Route::currentRouteName() == 'profile.edit')
<!-- Link to local js for editing users -->
<script type="text/javascript" src="{{asset('js/editUsers.js')}}"></script>

<!-- ADMIN PART -->
@elseif(Route::currentRouteName() == 'dcategories.manage')
<!-- Link to local styles for admin doctor categories -->
<script type="text/javascript" src="{{asset('js/admin/dcategories.js')}}"></script>
@elseif(Route::currentRouteName() == 'tags.manage')
<!-- Link to local styles for admin tags -->
<script type="text/javascript" src="{{asset('js/admin/tags.js')}}"></script>
@elseif(Route::currentRouteName() == 'roles.manage')
<!-- Link to local styles for roles-->
<script type="text/javascript" src="{{asset('js/admin/roles1.js')}}"></script>
@elseif(Route::currentRouteName() == 'contact.manage' || Route::currentRouteName() == "admin.dashboard")
<!-- Link to local styles for messages-->
<script type="text/javascript" src="{{asset('js/admin/messages1.js')}}"></script>
@elseif(Route::currentRouteName() == 'ads.index')
<!-- Link to local styles for admin ads-->
<script type="text/javascript" src="{{asset('js/admin/adds1.js')}}"></script>
@elseif(Route::currentRouteName() == 'doctors.manage.index'|| Route::currentRouteName() == 'admin.search.doctors' || Route::currentRouteName() == 'nusers.manage.index' || Route::currentRouteName() == "admin.search.nusers")
<!-- Link to local js for admin users-->
<script type="text/javascript" src="{{asset('js/admin/users1.js')}}"></script>
@endif

<script type="text/javascript">
	var token = '{{ Session::token() }}';
	var readMark = '{{route("readMark")}}';
	// retrive search result using ajax
	var questionsSearchResult = '{{route("searchResults.questions")}}';

	// route to access the 
</script>


@yield("scripts")

</body>
</html>