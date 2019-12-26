<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Page Not Found Online Teb</title>

	 <link rel="stylesheet" type="text/css" href="{{asset('css/ErrorStyle.css')}}">

</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>:(</h1>
			</div>
			@auth
			@if(Auth::user()->owner->status != 0)
				<h2>403 - Not Allowed</h2>
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
			<a href="{{route('main')}}">Home</a>

		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
