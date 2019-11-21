@extends("../layouts.LoginSignUpLayout")
@section("title","Login")

@section("logo")
<div id="loginSignUp-logo">
    <!-- <img src="{{asset('images/logo.png')}}" class="img-fluid"> -->
   &nbsp; a
</div>
@endsection

@section("form-title","Sign in to OMC")
@section("form")
@include('../layouts.messages')
    {!! Form::open(["method"=>"POST","action"=>"Auth\LoginController@login"]) !!}
        <div class="form-element-parent">
            {!! Form::text("email_username",null,["id"=>"email_username","class"=>"form-control form_element input-in-login","placeholder"=>"Username or email","onkeyup"=>"enableButton()","autofocus"]) !!}
            <i class="fad fa-user form-element-icon"></i>
            <p id="email_usernameError"></p>
        </div>
        <div class="form-element-parent">
            {!! Form::password("password",["id"=>"password","class"=>"form-control form_element input-in-login" ,"placeholder"=>"Password","onkeyup"=>"enableButton()"]) !!}
            <i class="fad fa-key form-element-icon"></i>
            <p id="loginPasswordError"></p>
        </div>
        {!! Form::checkbox("remember",null,null,["style"=>"clear:both"]) !!} 
        <label for="remember">keep me login</label>
        {!! Form::submit("Log In",["class"=>"btn btn-primary btn-sm btn-block", "id" => "form_button","onclick"=>"validateLogInForm()","disabled"=>"true"]) !!}
    {!! Form::close() !!}
@endsection

@section("orPart")
    <div class="col-5"><hr></div>
    <div class="col-2 " style="margin-top: 6px;">OR</div>
    <div class="col-5"><hr></div>
@endsection

@section("forgot-privacy-part") 
    <br>
    <a href="#" class="text-center">Forgot Password?</a>
@endsection


<!-- End login form div -->

@section("secondOption")
        Don't have an account? <a href="{{route('register')}}">Sign Up</a>
@endsection

