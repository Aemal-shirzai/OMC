@extends("../layouts.LoginSignUpLayout")


@section("title","Sign Up")

@section("logo")
<div id="loginSignUp-logo">
    <!-- <img src="{{asset('images/logo.png')}}" class="img-fluid"> -->
   &nbsp; a
</div>
@endsection

@section("form-title","Sign up to OMC")
@section("form")
    {!! Form::open(["method"=>"POST","action"=>"Auth\RegisterController@register"]) !!}
        {!! Form::text("fullName",null,["class"=>"form-control form_element ". ($errors->has("fullName") ? "registerBackEndErrorInput" : "") ,"id"=>"fullName","placeholder"=>"Full Name * ","onkeyup"=>"enableButtonSignup()","autofocus"]) !!}
        <p id="fullNameError" class="registerBackEndErrorMsgs">
            @error("fullName")
                {{ $message }}
            @enderror
        </p>

        {!! Form::text("username",null,["class"=>"form-control form_element ". ($errors->has("username") ? "registerBackEndErrorInput" : ""),"id"=>"username","placeholder"=>"Username min 4 charachters *","onkeyup"=>"enableButtonSignup()"]) !!}
        <p id="usernameError" style="margin-top: 0px;" class="registerBackEndErrorMsgs">
             @error("username")
                {{ $message }}
            @enderror
        </p>

        {!! Form::email("email",null,["class"=>"form-control form_element ". ($errors->has("email") ? "registerBackEndErrorInput" : ""),"id"=>"email","placeholder"=>"Email Address *","onkeyup"=>"enableButtonSignup()"]) !!}
        <p id="emailError" class="registerBackEndErrorMsgs">
             @error("email")
                {{ $message }}
            @enderror
        </p>

        
        {!! Form::select("registerAs",[""=>"Sign up AS",0=>"Normal User",1=>"Doctor"],null,["class"=>"form-control form_element ". ($errors->has("registerAs") ? "registerBackEndErrorInput" : ""),"id"=>"registerAs","onchange"=>"enableButtonSignup()"]) !!}
        <p id="registerAsError" class="registerBackEndErrorMsgs">
             @error("registerAs")
                {{ $message }}
            @enderror
        </p>

        <label>{!! Form::radio("gender","0",true) !!} Male</label>
        <label>{!! Form::radio("gender","1",null) !!} Female</label>
        <p id="genderError" class="registerBackEndErrorMsgss">
            @error("gender")
                    {{ $message }}
            @enderror
        </p>
        {!! Form::password("password",["class"=>"form-control form_element ". ($errors->has("password") ? "registerBackEndErrorInput" : ""),"id"=>"password","placeholder"=>"password min 8 charachters *","onkeyup"=>"enableButtonSignup()"]) !!}
        <p id="passwordError" class="registerBackEndErrorMsgs">
             @error("password")
                {{ $message }}
            @enderror
        </p>

        {!! Form::password("password_confirmation",["class"=>"form-control form_element ". ($errors->has("password-confirmation") ? "registerBackEndErrorInput" : ""),"id"=>"password_confirm","placeholder"=>"re enter password *","onkeyup"=>"enableButtonSignup()"]) !!}
        <p id="password-confirmError" class="registerBackEndErrorMsgs">
             @error("password_confirmation")
                {{ $message }}
            @enderror
        </p>

        {!! Form::submit("Sign up",["class"=>"btn btn-primary btn-sm btn-block", "id" => "form_button","onclick"=>"validateSignUpForm()","disabled"=>"true"]) !!}
    {!! Form::close() !!}
@endsection

@section("forgot-privacy-part") 
    This is our privacy and ploicy
@endsection


@section("secondOption")
    Have an account? <a href="{{route('login')}}">Log In</a>
@endsection