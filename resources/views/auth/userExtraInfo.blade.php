@extends("../layouts.LoginSignUpLayout")

@section("title","more info")



@section("form")
	<a href="javascript:void(0);">
		<div class="text-center mb-3">
			<div class="fal fa-user" id="userProfilePic">
				<span>Add Profile Picture</span>
			</div>
		</div>
	</a>
	<div>
		{!! Form::open(["method"=>"post","action"=>"Auth\RegisterController@moreInfoStore"]) !!}
			<div>
				{!! Form::label("address","Your Address & contact:") !!}
				<div class="row row-for-input">
					{!! Form::select("country",$provinces,null,["class"=>"form-control more_form_element col-lg-12","placeholder"=>"Your Country...","autofocus"=>"true","id"=>"country"]) !!}
					{!! Form::select("province",[""=>"Province"] + $provinces,null,["class"=>"form-control more_form_element col-lg-4"]) !!}
					<!-- <div class="col-lg-1"></div> -->
					{!! Form::select("distict",[""=>"District"] + $provinces,null,["class"=>"form-control more_form_element col-lg-4"]) !!}
					<!-- <div class="col-lg-1"></div> -->
					{!! Form::select("street",[""=>"Street"] + $provinces,null,["class"=>"form-control more_form_element col-lg-4"]) !!}
					{!! Form::text("phone",null,["class"=>"form-control more_form_element col-lg-12","placeholder"=>"Phone number ...","id"=>"phone"]) !!}
					<div class="dropdown-divider col-lg-12"></div>
				</div>
				{!! Form::file("photo",["class"=>"form-control mor_form_element","disabled"=>"true","style"=>"display:none;"]) !!}
				{!! Form::label("DOB","Date of birth:") !!}
				<div class="row row-for-input" id="DOBlabels">
					{!! Form::label("year","Year",["class"=>"col-lg-3"]) !!}
					<div class="col-lg-1"></div>
					{!! Form::label("month","Month",["class"=>"col-lg-3"]) !!}
					<div class="col-lg-1"></div>
					{!! Form::label("day","Day:",["class"=>"col-lg-3"]) !!}
				</div>
				<div class="row row-for-input">
					{!! Form::selectRange("year",1990,\Carbon\carbon::now()->format("Y"),null,["class"=>"form-control more_form_element col-lg-4"]) !!}
					<!-- <div class="col-lg-1"></div> -->
					{!! Form::selectMonth("month",null,["class"=>"form-control more_form_element col-lg-4"]) !!}
					<!-- <div class="col-lg-1"></div> -->
					{!! Form::selectRange("day",1,31,null,["class"=>"form-control more_form_element col-lg-4"]) !!}	
				</div>
				<div class="row row-for-input">
					{!! Form::submit("Add Info",["class"=>"btn btn-primary btn-sm btn-block col-lg-12", "id"=>"form_button"]) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>
@endsection


@section("forgot-privacy-part")
	This is our privacy and policy
@endsection



@section("secondOption")
	
	Set up later?<a href="#" class=""> Skip</a>

@endsection