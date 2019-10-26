@extends("../layouts.login-signup")


@section("title","Sign Up")

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





<!-- 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 -->