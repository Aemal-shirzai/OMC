@extends("../layouts.login-signup")


@section("title","Sign Up")

@section("form-title","Sign up to OMC")
@section("form")
@include('../layouts.messages')
    {!! Form::open(["method"=>"POST","action"=>"Auth\RegisterController@register"]) !!}
        {!! Form::text("fullName",null,["class"=>"form-control form_element","placeholder"=>"Full Name * ","required"]) !!}
        {!! Form::text("username",null,["class"=>"form-control form_element","placeholder"=>"Username *","required"]) !!}
        {!! Form::email("email",null,["class"=>"form-control form_element","placeholder"=>"Email Address *"]) !!}
        {!! Form::select("registerAs",[""=>"Sign up AS",0=>"Normal User",1=>"Doctor"],null,["class"=>"form-control form_element","required"]) !!}
        <label>{!! Form::radio("gender","0",true) !!} Male</label>
        <label>{!! Form::radio("gender","1",null) !!} Female</label>
        {!! Form::password("password",["class"=>"form-control form_element","placeholder"=>"password *","required"]) !!}
        {!! Form::password("password_confirmation",["class"=>"form-control form_element","placeholder"=>"re enter password *","required"]) !!}
        {!! Form::submit("Sign up",["class"=>"btn btn-primary btn-sm btn-block", "id" => "form_button"]) !!}
    {!! Form::close() !!}
@endsection

@section("forgot-privacy-part") 
    This is our privacy and ploicy
@endsection


@section("secondOption")
    Have an account? <a href="#">Log In</a>
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