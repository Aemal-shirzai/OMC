
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Link to bootstap app.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <!-- Link to local login style css file -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/loginStyle.css')}}">

    <!-- Linkt to fontawesome  -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css')}}">
</head>
<body>

<!-- Login Form -->
<div id="loginForm-container" class="col-lg-3 col-sm-5">
<div id="login-logo">
    <!-- <img src="{{asset('images/logo.png')}}" class="img-fluid"> -->
   &nbsp; a
</div>
<h5 class="text-center">Login with omc</h5>
<div id="loginForm">
    {!! Form::open() !!}
        {!! Form::text("email",null,["class"=>"form-control login_form_element","placeholder"=>"Username or email"]) !!}
        {!! Form::password("password",["class"=>"form-control login_form_element","placeholder"=>"Password"]) !!}
        
        {!! Form::checkbox("remember",null,null,["style"=>"clear:both"]) !!} 
        <label for="remember">keep me login</label>
        {!! Form::submit("Log In",["class"=>"btn btn-primary btn-sm btn-block", "id" => "login_form_button"]) !!}
    {!! Form::close() !!}
</div>
<div class="row" style="margin-top: 8px;">
    <div class="col-5"><hr></div>
    <div class="col-2 " style="margin-top: 6px;">OR</div>
    <div class="col-5"><hr></div>
</div>
<br>
<div class="text-center" id="forget">
    <a href="#" class="text-center">Forgot Password?</a>
</div>
</div> 
<!-- End login form div -->

<div id="signupButton" class="col-lg-3 col-sm-5">
    <div class="text-center">
        Don't have an account? <a href="#">Sign Up</a>
    </div>
</div>

<div id="login-footer" class="container text-center">
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
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
</body>
</html>
























<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
