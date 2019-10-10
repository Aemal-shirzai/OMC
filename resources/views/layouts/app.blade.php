<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<!-- Link to bootstap app.css -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

	<!-- Link to local css fild -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

	<!-- Linkt to fontawesome  -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css')}}">
</head>
<body>



<div id="parent-dev"><!-- parent Div start-->
	
	<div class="col-12 text-right" id="header-div"> <!-- header div start -->

		<div class="container-fluid"> <!-- header-content dev start -->
			<span class="float-left" id="timeAndDate">{{ Carbon\Carbon::now("Asia/kabul") }}</span>
			<a href="#" class="fas fa-search" id="search-icon"></a>&nbsp;
			<a href="#" class="login-register">Login</a>
			<a href="#" class="login-register">Register</a>	
		</div> <!-- header-content dev end -->

	</div><!-- header div end -->

	<div id="search-box-div"> <!-- search box div start -->
		{!! Form::open([]) !!}
			<div class="d-flex">
				<div class="btn btn-light search-box-button" id="search-close-button"><i class="fas fa-arrow-left"></i></div>
				{!! Form::text("search",null,["class"=>"form-control mr-1 form-control-lg search-box-button","placeholder"=>"Search here ...","id"=>"search-box","autofocus"]) !!}
			</div>
		{!! Form::close() !!}
	</div> <!-- search box div end -->

	<div style="width: 100%;background-color: white; height: 70px;margin-top: -2px;position: fixed;top: 48px;">
		
	</div>

</div><!-- Parent Div End -->




<!-- link to boootstrap app.js -->
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

<!-- link to local js file -->
<script type="text/javascript" src="{{asset('js/script1.js')}}"></script>



</body>
</html>