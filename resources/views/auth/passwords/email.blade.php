@extends("../layouts.LoginSignUpLayout")
@section("title","Reset Password")

@section("logo")

<div class="text-center" style="border: 1px solid #3fbbc0;border-radius: 50%;margin: 0 auto;width: 150px;height: 150px;padding: 45px 12px;">
        <img src="{{asset('images/mainLogo.png')}}" style="width: 120px;">
</div>
@endsection

@section("form-title","Reset password")
@section('form')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif   
    {!! Form::open(["method"=>"post","action"=>"Auth\ForgotPasswordController@sendResetLinkEmail"]) !!}
        <div class="form-element-parent">
            {!! Form::text("email",null,["id"=>"email","class"=>"form-control form_element input-in-login ".($errors->has('email') ? 'is-invalid' : '') ,"placeholder"=>"Type of your Email Address","onkeyup"=>"enableButtonReset()","autofocus","autocomplete"=>"email"]) !!}
            <i class="fad fa-envelope form-element-icon"></i>
            <p id="email_usernameError">
                @error("email")
                        {{$message}}
                @enderror
            </p>
        </div>
        {!! Form::submit("Send Password Reset Link",["class"=>"btn btn-primary btn-sm btn-block", "id" => "form_button","onclick"=>"validateLogInForm()","disabled"=>"true"]) !!}
    {!! Form::close() !!}
@endsection


@section("secondOption")
        <a href="{{route('register')}}">Sign Up</a>
        - OR -
        <a href="{{route('login')}}">Log In</a>
@endsection
