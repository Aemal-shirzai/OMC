<!DOCTYPE html>
<html>
<head>
	<title>@yield("title")</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<!-- Link to bootstap app.css -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

	<!-- Link to local css file -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/newStyle.css')}}">
	@if(Route::currentRouteName() == 'main')
	<!-- Link to local mian css file -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
	@endif
	
	<!-- Linkt to fontawesome  -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css')}}">	

</head>
<body>

<div class="sidebar-small" id="side"> <!-- navbar for small screen div start  -->
	<div id="sidebar-small-child-div">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="#" class="active">Home</a>
		<a href="#">Service</a>
		<a href="#">Doctors</a>
		<a href="#">Facilities</a>
		<a href="#">Pricing</a>
		<a href=""#>Extra <i class="far fa-caret-down"></i></a>
	</div>
</div><!-- navbar for small screen div end  -->


<div id="parent-div"><!-- parent Div start-->
	
	<div class="col-12 text-right" id="header-div"> <!-- header div start -->

		<div class="container"> <!-- header-content div start -->
			<span class="float-left" id="timeAndDate">{{ Carbon\Carbon::now("Asia/kabul") }}</span>
			<a href="#" class="far fa-search" id="search-icon"></a>&nbsp;
			<a href="{{route('login')}}" class="login-register">Login</a>
			<a href="{{route('register')}}" class="login-register">Register</a>	
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
		<a href=""#>Extra <i class="far fa-caret-down"></i></a>
		<a href="#">Pricing</a>
		<a href="#">Facilities</a>
		<a href="#">Doctors</a>
		<a href="#">Service</a>
		<a href="#" class="active">Home</a>
		</div>
	</div><!-- navbar for large screen div end  -->


<div>
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

<!-- link to local js file -->
<script type="text/javascript" src="{{asset('js/script1.js')}}"></script>



</body>
</html>