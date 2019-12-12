@extends("../layouts/MainLayout")

@section("title")
	Edit Profile . OnlineTeb
@endsection


@section("content")

@if($user && $account)
	<div id="editParent">
		<img src="{{asset('images/load.gif')}}" id="load">
		<!-- Delete confirmation box -->
			<div class="deleteAccountBox" id="deleteAccountBox" >
				<div class="deleteAccountText">Type Your Password</div>
				{!! Form::open(["method"=>"post","id"=>"deleteAccountForm"]) !!}
					{!! Form::password("password",["class"=>"form-control form-fields","placeholder"=>"Type your password to proceed","autofocus"=>"true","id"=>"accountDeletField" ]) !!}
					{!! Form::hidden("account_id",$account->id,["class"=>"form-control form-fields"]) !!}
				{!! Form::close() !!}
				<div id="accountDeleteError" class="mt-1"></div>
				<div class="deleteAccountRememberText">Remember: Your account will be deleted permanantly</div>
				<a href="javascript:void(0)" onclick="deleteAccount()" class="btn btn-danger btn-sm deleteAccountButtons" id="deleteProceedButton">Delete</a>
				<img src="{{asset('images/load3.gif')}}" id="deleteLoading">
				<a href="javascript:void(0)" onclick="deleteAccountBoxClose()" class="btn btn-light btn-sm deleteAccountButtons mb-1">Cancel</a>
			</div>

		<!-- options for edit -->
		<div id="editOptions">
			<button class="tabLinks active1" onclick="openContent(event,'editProfileForm')">Profile Settings</button>
			<button class="tabLinks" id="accountSettings" onclick="openContent(event,'editAccountForm')">Account Settings</button>
			<button class="tabLinks" onclick="openContent(event,'editPassword')">Password Settings</button>
		</div>
		<!-- form for edit -->
		<div id="editProfileForm" class="tab-content editForm" style="">
			@if(session('updateSuccess'))
				<div class="alert alert-success alert-sm serverMsgs">
					<button class="close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
					{{session("updateSuccess")}}
				</div>
			@endif
			@if(session('updateError'))
				<div class="alert alert-danger alert-sm serverMsgs">
					<button class="close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
					{{session("updateError")}}
				</div>
			@endif
			<div id="changePhoto">
				<div id="userPhoto">
					<!-- this image is for ajax after its beign uploaded to show this one  -->
					<img class="newImage image" src=""  onclick="changePhotoConfirmation()" title="Change Profile Photo" style="display: none;">
					@if($account->photos()->where("status","1")->first())
						@if($account->owner_type == "App\Doctor")
							<img class="image" src="/storage/images/doctors/{{$account->photos()->where('status',1)->first()->path}}" onclick="changePhotoConfirmation()" title="Change Profile Photo">
						@else
							<img class="image" src="/storage/images/normalUsers/{{$account->photos()->where('status',1)->first()->path}}" 	 onclick="changePhotoConfirmation()" title="Change Profile Photo">
						@endif	
					@else
						<span id="notImage" class="fal fa-user-circle"   onclick="changePhotoConfirmation()" title="Change Profile Photo"></span>
					@endif
						<!-- this no image is just for ajax  to show it afte successs -->
						<span id="notImage" class="fal fa-user-circle" style="display: none;"   onclick="changePhotoConfirmation()" title="Change Profile Photo"></span>
						<img src="{{asset('images/load.gif')}}" id="loading">
				</div>
				<div id="userNameAndChangeBtn">
					<span id="username">{{$account->username}}</span>
					<a href="javascript:void(0)" id="changePhotoLink" onclick="changePhotoConfirmation()" title="Change Profile Photo">Change Profile Photo</a>
						<span class="errors  mb-2" id="photoErrorMessage">
						@error('photo')
							{{ $message }}
						@enderror
					</span>
				</div>
			</div>

			<div class="confirmationBox" id="changeConfirmationBox">
				<div id="text" class="changeOptions">Change Profile Photo</div>
				<div class="dropdown-divider"></div>
				<div id="textUpload" class="changeOptions"><a href="javascript:void(0)" onclick="openphotoField()">Change Photo</a></div>
				<div class="dropdown-divider"></div>
				<!-- This is for ajax request to show it after that photo is beign uploaded-->
				<div id="textRemove" class="changeOptions removeTextAndDivider removeForAjax" style="display: none"><a href="javascript:void(0)" onclick="removeprofilePhoto('{{$account->id}}')">Remove Current Photo</a></div>
				<div id="removeDivider" class="dropdown-divider removeTextAndDivider removeForAjax" style="display: none;"></div>
				<!-- End of  -->
				@if($account->photos()->where("status","1")->first())
				<div id="textRemove" class="changeOptions removeTextAndDivider"><a href="javascript:void(0)" onclick="removeprofilePhoto('{{$account->id}}')">Remove Current Photo</a></div>
				<div  class="dropdown-divider removeTextAndDivider"></div>
				@endif
				<div id="textCancel" class="changeOptions"><a href="javascript:void(0)" onclick="changePhotoConfirmationClose()" >Cancel</a></div>
			</div>
			{!! Form::open(["method"=>"POST","files"=>"true","id"=>"uploadPhotoForm"]) !!}
				<div class="form-elements input-group">
					{!! Form::label("photo","Photo",["class"=>"form-labels","style"=>"display:none"]) !!}
					{!! Form::file("photo",["class"=>"form-control form-fields","id"=>"profilePhotoField","disabled"=>"true","style"=>"display : none"]) !!}
					{!! Form::hidden("userId",$account->id) !!}
				</div>
			{!! Form::close() !!}
			{!! Form::model($user,["method"=>"PUT","action"=>["ProfileController@updateProfile",$account->id],"files"=>"true"]) !!}
				<div class="form-elements input-group">
					{!! Form::label("fullName","Full Name",["class"=>"form-labels"]) !!}
					{!! Form::text("fullName",null,["class"=>"form-control form-fields ".($errors->has('fullName') ? ' formErrors' : ''),"id"=>"fullName","maxlength"=>"60"]) !!}
					<div class="inputErrors" id="fullNameError">
						@error('fullName')
							{{$message}}
						@enderror
					</div>
				</div>
				<div class="form-elements input-group">
					{!! Form::label("country_id","Address",["class"=>"form-labels"]) !!}
					{!! Form::select("country_id",$countries,null,["class"=>"form-control form-fields address ".($errors->has('country_id') ? ' formErrors' : ''),"placeholder"=>"country", "id"=>"country", "onchange"=> "selectProvinceAndDistrict('province')"]) !!}
					{!! Form::select("province_id",$userContryProvinces,null,["class"=>"form-control form-fields address ".($errors->has('province_id') ? ' formErrors' : ''),"placeholder"=>"province" , "id"=>"province",
					"onchange"=>"selectProvinceAndDistrict('district')"]) !!}
					{!! Form::select("district_id",$userProvinceDistricts,null,["class"=>"form-control form-fields address ".($errors->has('district_id') ? ' formErrors' : ''),"placeholder"=>"district", "id"=>"district"]) !!}
					<div class="inputErrors" id="addressError">
						@if(session("country_id"))
							{{session("country_id")}}
						@endif
						@error('country_id'){{ $message }}@enderror
						@error('province_id'){{ $message }}@enderror
						@error('district_id'){{ $message }}@enderror
					</div>
				</div>
				<div class="form-elements input-group">
					{!! Form::label("street","Detailed Address",["class"=>"form-labels"]) !!}
					{!! Form::text("street",null,["class"=>"form-control form-fields ".($errors->has('street') ? ' formErrors' : ''),"id"=>"street"]) !!}
					<div class="inputErrors" id="streetError">
						@error('street')
							{{ $message }}
						@enderror
					</div>
				</div>
				<div class="form-elements input-group">
					{!! Form::label("gender","Gender",["class"=>"form-labels"]) !!}
					<label class="mt-1 mr-2 genderLabels">{!! Form::radio("gender","0",null) !!} Male</label>
        			<label class="mt-1 genderLabels">{!! Form::radio("gender","1",null) !!} Female</label>
        			<div class="inputErrors" id="genderError">
						@error('gender')
							{{ $message }}
						@enderror
					</div>
				</div>
				<div class="form-elements input-group">
					{!! Form::label("year","Date Of Birth",["class"=>"form-labels"]) !!}
					{!! Form::selectRange("year",1950,\Carbon\carbon::now()->format("Y"),null,["class"=>"form-control form-fields date ".($errors->has('year') ? ' formErrors' : ''),"id"=>"year"]) !!}
					{!! Form::selectMonth("month",null,["class"=>"form-control form-fields date ".($errors->has('month') ? ' formErrors' : ''),"id"=>"month"]) !!}
					{!! Form::selectRange("day",1,31,null,["class"=>"form-control form-fields date ".($errors->has('day') ? ' formErrors' : ''),"id"=>"day"]) !!}
					<div class="inputErrors" id="dobError">
						@error('year'){{ $message }}@enderror
						@error('month'){{ $message }}@enderror
						@error('day'){{ $message }}@enderror
					</div>	
				</div>
				<div class="form-elements input-group">
					{!! Form::label("Bio","Bio",["class"=>"form-labels"]) !!}
					{!! Form::textarea("Bio",null,["class"=>"form-control form-fields ".($errors->has('Bio') ? ' formErrors' : ''), "id"=>"biography", "rows"=>"4", "maxlength"=>"200", "style"=>"resize:none","placeholder"=>"max of 200 chars"]) !!}
					<div class="inputErrors" id="bioError">
						@error('Bio')
							{{ $message }}
						@enderror
					</div>
				</div>
				@can("doctor_related",$account)
				<div class="form-elements input-group">
					{!! Form::label("specialization","Your specialization",["class"=>"form-labels"]) !!}
					<a href="javascrip:void(0)" onclick="showTags()" id="addTagLink"  class="{{ ($errors->has('fields') ? 'errorButton' :  '') }}">
						<span id="tagsCount" class="badge badge-pill badge-light">{{$user->fields()->count()}}</span> &nbsp;
						Select Your specialized field
					</a>
					<span class="ErrorMessage  mb-2" id="tagsErrorMessage">
						@error('fields')
							{{ $message }}
						@enderror
					</span>
					<!-- old Tags part  -->
					<div class="tags">
						@if($user->fields()->count() > 0)
							@foreach($user->fields as $field)
								<div style="overflow: hidden;" onclick="removeTags('{{$field->id}}')" id="oldTag-{{$field->id}}">
									<button class="close">
										&times;
									</button>
									<a href="javascript:void()">
										{{$field->category}}
									</a>
								</div>
							@endforeach
						@endif
					</div>
					<!-- old tags part end -->

					<div class="clearfix"></div>
					<span class="far fa-question" id="tagInfoIcon" onclick="showTagInfo()"></span>
					<div id="tagInfo">
						<h6>How to add Specialized Field?</h6>
						<span>Choosing your field help poeple find you easily, and it describes your spicialized field</span>
						<ul>
							<li>Click on the (Select Your specialized field) button bellow</li>
							<li>You will be opend a list of fileds you can select maximum 5 fields</li>
						</ul>
						<h6>If your desired field is not in list:</h6>
						<span>Then just <a href="#">ask US to add one for you</a></span>
					</div>
					<div id="tags">
						<table class="table">
							<thead>
								<tr>
									<th>Tag Name</th>
									<th>Select</th>
								</tr>
							</thead>
							<tbody>
								<span id="tagsNote">Choose with maximum of 5 fields</span>
								<a href="javascript:void(0)" onclick="showTags()" class="btn btn-sm" id="tagsDoneBtn">Done</a>
								@if(count($categories) > 0)
								@foreach($categories as $d_category)
								<tr>
									<td><label> {{$d_category->category}} </label></td>
									<td>{!! Form::checkbox("fields[]",$d_category->id,null,["class"=>"tagsCheckboxes ml-4","id"=>"tag-$d_category->id","onchange"=>"showAndValidateTagsCountEdit('$d_category->id')"]) !!}</td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
				<!-- doctor tags or category part end -->
				@endcan 
				<div class="form-elements input-group">
					<span class="form-labels"></span>
					{!! Form::submit("Update",["class" => "btn btn-sm mt-2 submitButton","onclick"=>"validateProfileEditForm()"]) !!}
				</div>
			{!! Form::close() !!}
		</div>

		<!-- //////////////////////////////////////////////////////////////////////////////  PART 2   /////////////////////////////////////////////// -->
		<!-- for editing  or account information -->
		<div class="tab-content editForm" id="editAccountForm" style="display: none;">
			@if(session('accountUpdateSuccess'))
				<div class="alert alert-success alert-sm serverMsgs">
					<button class="close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
					{{session("accountUpdateSuccess")}}
				</div>
			@endif
			@if(session('accountUpdateError'))
				<div class="alert alert-danger alert-sm serverMsgs">
					<button class="close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
					{{session("accountUpdateError")}}
				</div>
			@endif
			<div id="changePhoto" class="mb-2">
				<div id="userPhoto">
					@if($account->photos()->where("status","1")->first())
						@if($account->owner_type == "App\Doctor")
							<img class="image" src="/storage/images/doctors/{{$account->photos()->where('status',1)->first()->path}}" style="cursor: initial;" title="Profile Photo">
						@else
							<img class="image" src="/storage/images/normalUsers/{{$account->photos()->where('status',1)->first()->path}}" title="Profile Photo" style="cursor: initial;">
						@endif	
					@else
						<span id="notImage" class="fal fa-user-circle"  title="No Profile Photo" style="cursor: initial;"></span>
					@endif
						<!-- this no image is just for ajax  to show it afte successs -->
						<span id="notImage" class="fal fa-user-circle" style="display: none;"   onclick="changePhotoConfirmation()" title="Change Profile Photo"></span>
						<img src="{{asset('images/load1.gif')}}" id="loading">
				</div>
				<div id="userNameAndChangeBtn" class="mt-2">
					<span id="username">{{$account->username}}</span>
				</div>
			</div>
			<!-- End of showing user photo -->
			<!-- Beggining  of form for editing account -->
			{!! Form::model($account,["method"=>"PUT","action"=>["ProfileController@updateAccount",$account->username]]) !!}
				<div class="form-elements input-group">
					{!! Form::label("username","Username",["class"=>"form-labels"]) !!}
					{!! Form::text("username",null,["class"=>"form-control form-fields ".($errors->has('username') ? ' formErrors' : ''),"id"=>"formUsername","maxlength"=>"20", "onkeyup"=>"enableAccountBtn()"]) !!}
					<div class="inputErrors" id="usernameError">
						@error('username')
							{{ $message }}
						@enderror
					</div>
				</div>
				<div class="form-elements input-group">
					{!! Form::label("email","Email Address",["class"=>"form-labels"]) !!}
					{!! Form::text("email",null,["class"=>"form-control form-fields ".($errors->has('email') ? ' formErrors' : ''),"id"=>"email","maxlength"=>"100" , "onkeyup"=>"enableAccountBtn()"]) !!}
					<div class="inputErrors" id="emailError">
						@error('email')
							{{ $message }}
						@enderror
					</div>
				</div>
				<div class="form-elements input-group">
					{!! Form::label("oPhone","Office Phone",["class"=>"form-labels"]) !!}
					{!! Form::text("oPhone",null,["class"=>"form-control form-fields ".($errors->has('oPhone') ? ' formErrors' : ''),"id"=>"oPhone","maxlength"=>"25 ", "onkeyup"=>"enableAccountBtn()"]) !!}
					<div class="inputErrors" id="oPhoneError">
						@error('oPhone')
							{{ $message }}
						@enderror
					</div>
				</div>	
				<div class="form-elements input-group">
					{!! Form::label("pPhone","Personal Phone",["class"=>"form-labels"]) !!}
					{!! Form::text("pPhone",null,["class"=>"form-control form-fields ".($errors->has('pPhone') ? ' formErrors' : ''),"id"=>"pPhone","maxlength"=>"25 ", "onkeyup"=>"enableAccountBtn()"]) !!}
					<div class="inputErrors" id="pPhoneError">
						@error('pPhone')
							{{ $message }}
						@enderror
					</div>
				</div>
				<div class="form-elements input-group">
					<span class="note">If you change your username and email address, then you have to enter your new username or email address for authentication</span>
				</div>
				<div class="form-elements input-group">
					{!! Form::label("","",["class"=>"form-labels"]) !!}
					{!! Form::submit("Update account settings",["class" => "btn btn-sm mt-2 accountSubmitButton submitButton ","disabled"=>"true", "onclick"=>"validateAccountForm()"]) !!}
				</div>
			{!! Form::close() !!}
			<a href="javascript:void(0)" onclick="deleteAccountBoxOpen()" class="btn  btn-sm" id="deleteAccountButton">Delete my account</a>
		</div>

		<!-- //////////////////////////////////////////////////////////////////////////////  PART 3   /////////////////////////////////////////////// -->
		<!-- for editing  or account information -->
		<div class="tab-content editForm" id="editPassword" style="display: none;">
			<div class="alert alert-danger alert-sm serverMsgs" id="changePassMessage" style="display: none;">
					<button class="close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
					<span id="changePassMessageContent"></span>
			</div>
			<div id="changePhoto">
				<div id="userPhoto">
					<!-- this image is for ajax after its beign uploaded to show this one  -->
					@if($account->photos()->where("status","1")->first())
						@if($account->owner_type == "App\Doctor")
							<img class="image" src="/storage/images/doctors/{{$account->photos()->where('status',1)->first()->path}}" title="profile photo" style="cursor: initial;">
						@else
							<img class="image" src="/storage/images/normalUsers/{{$account->photos()->where('status',1)->first()->path}}" title="profile photo" 	style="cursor: initial;" >
						@endif	
					@else
						<span id="notImage" class="fal fa-user-circle"  title="No profile photo" style="cursor: initial;"></span>
					@endif
				</div>
				<div id="userNameAndChangeBtn" class="mt-2">
					<span id="username">{{$account->username}}</span>
				</div>
			</div>
			<!-- End of showing user photo -->
			<!-- beggiin of form for editing account -->
			{!! Form::open(["method"=>"PUT","action"=>"ProfileController@changePassword","id"=>'changePasswordForm']) !!}
				<div class="changePassword">Change Password</div>
				<div class="form-elements input-group">
					{!! Form::label("old_password","Old Password",["class"=>"form-labels"]) !!}
					{!! Form::password("old_password",["class"=>"form-control form-fields ".($errors->has('old_password') ? ' formErrors' : ''),"id"=>"old_password", "maxlength"=>"60","onkeyup"=>"enablePassChangeBtn()"]) !!}
					<div class="inputErrors" id="oldPasswordError">
						@error('old_password')
							{{ $message }}
						@enderror
					</div>
					<img src="{{asset('images/load.gif')}}" class="changePasswordLoad">
				</div>
				<div class="form-elements input-group">
					{!! Form::label("new_password","New Password",["class"=>"form-labels"]) !!}
					{!! Form::password("new_password",["class"=>"form-control form-fields ".($errors->has('new_password') ? ' formErrors' : ''),"id"=>"new_password", "maxlength"=>"60" ,"onkeyup"=>"enablePassChangeBtn()"]) !!}
					<div class="inputErrors" id="newPasswordError">
						@error('new_password')
							{{ $message }}
						@enderror
					</div>
					<img src="{{asset('images/load.gif')}}" class="changePasswordLoad">
				</div>
				<div class="form-elements input-group">
					{!! Form::label("password_confirmation","Confirm New Password",["class"=>"form-labels"]) !!}
					{!! Form::password("new_password_confirmation",["class"=>"form-control form-fields ".($errors->has('new_password_confirmation') ? ' formErrors' : '' ), "id"=>"new_password_confirmation" ,"maxlength"=>"60" ,"onkeyup"=>"enablePassChangeBtn()"]) !!}
					<div class="inputErrors" id="passwordConfirmationError">
						@error('password_confirmation')
							{{ $message }}
						@enderror
					</div>
					<img src="{{asset('images/load.gif')}}" class="changePasswordLoad">
				</div>
				<div class="form-elements input-group mb-0">
					{!! Form::label("","",["class"=>"form-labels"]) !!}
					<label>{!! Form::checkbox("keepLogin",1) !!} <small>Keep me login </small></label>
				</div>
				<div class="form-elements input-group">
					<span class="note">You must provide your new password for authentication and your old password will not be valid anymore, if you change your password</span>
					<span class="note"><a href="#" style="color: #3fbbc0;">Forgot Password?</a></span>
				</div>
				{!! Form::hidden("userId",$account->id) !!}
				<div class="form-elements input-group">
					{!! Form::label("","",["class"=>"form-labels"]) !!}
					{!! Form::submit("Change Password",["class" => "btn btn-sm mt-2 submitButton","id"=>"changePasswordButton","onclick"=>"validatePasswordForm()","disabled"=>"true"]) !!}
				</div>
			{!! Form::close() !!}
		</div>
		<!-- End for changing password- -->
		<div class="clearfix"></div>
	</div>
@endif

@endsection


@section("scripts")


@if(session('accountUpdateSuccess') || session('accountUpdateError') || $errors->has('username') || $errors->has('email') || $errors->has("oPhone") || $errors->has('pPhone'))
		<script type="text/javascript">
			openContent1("accountSettings",'editAccountForm');
		</script>
@endif



<!-- To pass provinces and districts to js -->
@if($latestCountry)
	@for($index = 1 ; $index <= $latestCountry->id; $index++ )
         @if($country = App\Country::find($index))
		<script type="text/javascript">
			var {!! 'province' . $index !!} = {!! json_encode($country->provinces()->pluck("province","id")) !!};
		</script>
		@endif
	@endfor
@endif

@if($lastestProvince)
	@for($Pindex = 1 ; $Pindex <= $lastestProvince->id; $Pindex++ )
         @if($province = App\Province::find($Pindex))
		<script type="text/javascript">
			var {!! 'district' . $Pindex !!} = {!! json_encode($province->districts()->pluck("district","id")) !!};
		</script>
		@endif
	@endfor
@endif

<script type="text/javascript">
	var token = '{{ Session::token() }}';
	var removePhoto = '{{route("profile.removePhoto")}}';
	var uploadPhoto = '{{route("profile.uploadPhoto")}}';
	var accountDelete = '{{route("deleteAccount")}}';
	var login = '{{route("login")}}';
	var passwordChange = '{{route("changepassword")}}';
</script>


@endsection