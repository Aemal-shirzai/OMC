@extends("../layouts.login-signup")
@section("title","Sign Up")

@section("form-title","Sign up to OMC")
@section("form")
    {!! Form::open(["method"=>"POST","action"=>"LoginController@login"]) !!}
        {!! Form::text("fullName",null,["class"=>"form-control form_element","placeholder"=>"Full Name * ","required"]) !!}
        {!! Form::text("username",null,["class"=>"form-control form_element","placeholder"=>"Username *","required"]) !!}
        {!! Form::email("email",null,["class"=>"form-control form_element","placeholder"=>"Email Address *"]) !!}
        {!! Form::select("role_id",[""=>"Sign up AS",0=>"Normal User",1=>"Doctor"],null,["class"=>"form-control form_element","required"]) !!}
        <label>{!! Form::radio("gender","male",true) !!} Male</label>
        <label>{!! Form::radio("gender","female",null) !!} Female</label>
        {!! Form::password("password",["class"=>"form-control form_element","placeholder"=>"password *","required"]) !!}
        {!! Form::password("password-confirmation",["class"=>"form-control form_element","placeholder"=>"re enter password *","required"]) !!}
        {!! Form::submit("Sign up",["class"=>"btn btn-primary btn-sm btn-block", "id" => "form_button"]) !!}
    {!! Form::close() !!}
@endsection

@section("forgot-privacy-part") 
    This is our privacy and ploicy
@endsection


@section("secondOption")
    Have an account? <a href="#">Log In</a>
@endsection





