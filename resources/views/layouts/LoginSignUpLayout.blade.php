
<!DOCTYPE html>
<html>
<head>
    <title>@yield("title")</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('images/mainLogo.png')}}">
    <!-- Link to bootstap app.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <!-- Link to local login style css file -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/loginSignUpStyle22.css')}}">

    <!-- Linkt to fontawesome  -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css')}}">

    <script type="text/javascript"></script>
</head>
<body>

<!-- Form -->

<div @if(Route::currentRouteName() == 'login') id="loginForm-container" @elseif(Route::currentRouteName() == 'register') id="signUpForm-container"     @elseif(Route::currentRouteName() == 'moreInfo.index') id="moreInfo-container" @elseif(Route::currentRouteName() == 'password.request') id="loginForm-container") @elseif(Route::currentRouteName() == 'password.reset') id="loginForm-container") @endif class="col-lg-4 col-sm-5">
        
        @yield("logo")

        <h5 class="text-center" id="form-title">@yield("form-title")</h5>
        <div id="loginSignUpForm">
            @yield("form")
        </div>

        <div class="row" style="margin-top: 8px;">
            @yield("orPart")
        </div>

        <div class="text-center" id="forget">
            @yield("forgot-privacy-part")
        </div>
</div>


<!--login form div -->

<div @if(Route::currentRouteName() == 'login') id="loginButton" @elseif(Route::currentRouteName() == 'register') id="signUpButton" @elseif(Route::currentRouteName() == 'moreInfo.index') id="skipButton" @elseif(Route::currentRouteName() == 'password.request') id="loginButton") @elseif(Route::currentRouteName() == 'password.reset') id="loginButton") @endif  class="col-lg-4 col-sm-5">
    <div class="text-center">
       @yield("secondOption")
    </div>
</div>


<div id="loginSignUp-footer" class="container text-center">
    <ul>
        <li><a href="#">about omc</a></li>
        <li><a href="#">About Developers</a></li>
        <li><a href="#">contact us</a></li>
        <li><a href="#">privacy & ploicy</a></li>
        <li><a href="#">questions</a></li>
        <li><a href="#">jobs</a></li>
        <li><a href="#">addvertisements</a></li>
        <li><a href="#">tags</a></li>
    </ul>
</div>


<!-- link to boootstrap app.js -->
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

<!-- link to local js file -->
<script type="text/javascript" src="{{asset('js/loginSignUpScript221.js')}}"></script>
</body>
</html>
