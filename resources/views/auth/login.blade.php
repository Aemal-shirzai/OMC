@extends("../layouts.login-signup")
@section("title","Login")
@section("form-title","Sign in to OMC")
@section("form")
@include('../layouts.messages')
    {!! Form::open(["method"=>"POST","action"=>"Auth\LoginController@login"]) !!}
        {!! Form::text("email_username",null,["id"=>"email_username","class"=>"form-control form_element","placeholder"=>"Username or email"]) !!}
        {!! Form::password("password",["class"=>"form-control form_element" ,"placeholder"=>"Password"]) !!}
        
        {!! Form::checkbox("remember",null,null,["style"=>"clear:both"]) !!} 
        <label for="remember">keep me login</label>
        {!! Form::submit("Log In",["class"=>"btn btn-primary btn-sm btn-block", "id" => "form_button"]) !!}
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
        Don't have an account? <a href="#">Sign Up</a>
@endsection

