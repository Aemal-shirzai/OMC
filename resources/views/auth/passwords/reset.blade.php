@extends("../layouts.LoginSignUpLayout")
@section("title","Reset Password")

@section("logo")

<div class="text-center" style="border: 1px solid #3fbbc0;border-radius: 50%;margin: 0 auto;width: 150px;height: 150px;padding: 45px 12px;">
        <img src="{{asset('images/mainLogo.png')}}" style="width: 120px;">
</div>
@endsection

@section("form-title","Reset password")
@section('form')

{!! Form::open(["method"=>"post","action"=>"Auth\ResetPasswordController@reset"]) !!}
        <div class="form-element-parent">
            {!! Form::hidden("token",$token) !!}
            {!! Form::text("email",old('email'),["id"=>"email","class"=>"form-control form_element input-in-login ".($errors->has('email') ? 'is-invalid' : '') ,"placeholder"=>"Type of your Email Address","onkeyup"=>"enableButtonReset2()","autofocus","autocomplete"=>"email"]) !!}
            <i class="fad fa-envelope form-element-icon"></i>
            <p id="email_usernameError" class="invalid-feedback">
                @error("email")
                    {{$message}}
                @enderror
            </p>
        </div> 
        <div class="form-element-parent">
            {!! Form::password("password",["id"=>"password","class"=>"form-control form_element input-in-login ".($errors->has('password') ? 'is-invalid' : '') ,"placeholder"=>"new Password","onkeyup"=>"enableButtonReset2()","autocomplete"=>"new-password"]) !!}
            <i class="fad fa-lock form-element-icon"></i>
            <p id="passwordError" class="invalid-feedback">
                @error("password")
                    {{$message}}
                @enderror
            </p>
        </div> 

        <div class="form-element-parent">
            {!! Form::password("password_confirmation",["id"=>"password-confirm","class"=>"form-control form_element input-in-login", "placeholder"=>"Password confirmation","onkeyup"=>"enableButtonReset2()","autocomplete"=>"new-password"]) !!}
            <i class="fad fa-eye form-element-icon"></i>
        </div>


        {!! Form::submit("Reset Password",["class"=>"btn btn-primary btn-sm btn-block", "id" => "form_button","onclick"=>"validateLogInForm()","disabled"=>"true"]) !!}
    {!! Form::close() !!}
@endsection


@section("secondOption")
        <a href="{{route('register')}}">Sign Up</a>
        - OR -
        <a href="{{route('login')}}">Log In</a>
@endsection
