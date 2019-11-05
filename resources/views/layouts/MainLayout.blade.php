	<!DOCTYPE html>
<html>
<head>
	<title>@yield("title")</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<!-- Link to bootstap app.css -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

	<!-- Link to local css file -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/MainLayoutStyle1.css')}}">
	@if(Route::currentRouteName() == 'main')
	<!-- Link to local mian css file -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
	@elseif(Route::currentRouteName() == 'profile')
	<!-- Link to local profile style for profile page -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/profileStyle11.css')}}">
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
		<a href="#"><span class="fal fa-user-md"></span> Doctors</a>
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

	<div id="sidebar-large"> <!-- navbar for large screen div start  -->
		<div class="container">
		<div id="logodiv" class="float-left">
		<a href="#"><img src="{{asset('images/logo.png')}}" class="img-fluid"></a>
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
		@endauth
		<a href="javascript:void(0)" class="contactUs">Contact Us</a>
		<a href="#">Tags</a>
		<a href="#">Doctors</a>
		<a href="{{route('main')}}" @if(Route::currentRouteName() == 'main')class="active" @endif>Home</a>
		</div>
	</div>
<!-- navbar for large screen div end  -->


<div id="mainParent">
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
				<a href="#">Doctors <span class="badge badge-secondary">2000</span></a>
				<a href="#">Users <span class="badge badge-secondary">2000</span></a>
				<a href="#">Tags <span class="badge badge-secondary">2000</span></a>
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

<!-- link to local js file -->
<script type="text/javascript" src="{{asset('js/MainLayoutScript1.js')}}"></script>

@if(Route::currentRouteName() == 'profile')
<!-- link to local js file for profile page -->
<script type="text/javascript" src="{{asset('js/profileScript1.js')}}"></script>
@endif

</body>
</html>