@extends("../layouts/MainLayout")

@section("title")
	Edit Profile . OnlineTeb
@endsection


@section("content")

@if($user && $account)
	<div id="editParent">
		<!-- options for edit -->
		<div id="editOptions">
			<button class="tabLinks active1" onclick="openContent(event,'editProfileForm')">Edit Profile</button>
			<button class="tabLinks" onclick="openContent(event,'editAccountForm')">Edit Account</button>
		</div>
		<!-- form for edit -->
		<div id="editProfileForm" class="tab-content editForm">
			<div id="changePhoto">
				<div id="userPhoto">
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
						<img src="{{asset('images/load1.gif')}}" id="loading">
				</div>
				<div id="userNameAndChangeBtn">
					<span id="username">{{$account->username}}</span>
					<a href="javascript:void(0)" id="changePhotoLink" onclick="changePhotoConfirmation()" title="Change Profile Photo">Change Profile Photo</a>
				</div>
			</div>

			<div class="confirmationBox" id="changeConfirmationBox">
				<div id="text" class="changeOptions">Change Profile Photo</div>
				<div class="dropdown-divider"></div>
				<div id="textUpload" class="changeOptions"><a href="javascript:void(0)" onclick="openphotoField()">Upload Photo</a></div>
				<div class="dropdown-divider"></div>
				@if($account->photos()->where("status","1")->first())
				<div id="textRemove" class="changeOptions"><a href="javascript:void(0)" onclick="removeprofilePhoto('{{$account->id}}')">Remove Current Photo</a></div>
				<div class="dropdown-divider"></div>
				@endif
				<div id="textCancel" class="changeOptions"><a href="javascript:void(0)" onclick="changePhotoConfirmationClose()" >Cancel</a></div>
			</div>

			{!! Form::model($user,["method"=>"POST","files"=>"true"]) !!}
				<div class="form-elements input-group">
					{!! Form::label("photo","Photo",["class"=>"form-labels","style"=>"display:none"]) !!}
					{!! Form::file("photo",["class"=>"form-control form-fields","disabled"=>"true","style"=>"display : none"]) !!}
				</div>
				<div class="form-elements input-group">
					{!! Form::label("fullName","Full Name",["class"=>"form-labels"]) !!}
					{!! Form::text("fullName",null,["class"=>"form-control form-fields"]) !!}
				</div>
				<div class="form-elements input-group">
					{!! Form::label("country_id","Address",["class"=>"form-labels"]) !!}
					{!! Form::select("country_id",$countries,null,["class"=>"form-control form-fields address","placeholder"=>"country", "id"=>"country", "onchange"=> "selectProvinceAndDistrict('province')"]) !!}
					{!! Form::select("province_id",$userContryProvinces,null,["class"=>"form-control form-fields address","placeholder"=>"province" , "id"=>"province",
					"onchange"=>"selectProvinceAndDistrict('district')"]) !!}
					{!! Form::select("district_id",$userProvinceDistricts,null,["class"=>"form-control form-fields address","placeholder"=>"district", "id"=>"district"]) !!}
				</div>
				<div class="form-elements input-group">
					{!! Form::label("street","Detailed Address",["class"=>"form-labels"]) !!}
					{!! Form::text("street",null,["class"=>"form-control form-fields"]) !!}
				</div>
				<div class="form-elements input-group">
					{!! Form::label("gender","Gender",["class"=>"form-labels"]) !!}
					<label class="mt-1 mr-2 genderLabels">{!! Form::radio("gender","0",null) !!} Male</label>
        			<label class="mt-1 genderLabels">{!! Form::radio("gender","1",null) !!} Female</label>
				</div>
				<div class="form-elements input-group">
					{!! Form::label("year","Date Of Birth",["class"=>"form-labels"]) !!}
					{!! Form::selectRange("year",1950,\Carbon\carbon::now()->format("Y"),null,["class"=>"form-control form-fields".($errors->has('year') ? ' moreInfoFormErrorsInput' : ''),"id"=>"year"]) !!}
					{!! Form::selectMonth("month",null,["class"=>"form-control form-fields","id"=>"month"]) !!}
					{!! Form::selectRange("day",1,31,null,["class"=>"form-control form-fields","id"=>"day"]) !!}	
				</div>
				<div class="form-elements input-group">
					{!! Form::label("Bio","Bio",["class"=>"form-labels"]) !!}
					{!! Form::textarea("Bio",null,["class"=>"form-control form-fields", "id"=>"biography", "rows"=>"4", "maxlength"=>"200", "style"=>"resize:none","placeholder"=>"max of 200 chars"]) !!}
				</div>

				<div class="form-elements input-group">
					<span class="form-labels"></span>
					{!! Form::submit("Update",["class" => "btn btn-sm mt-2","id"=>"submitButton"]) !!}
				</div>
			{!! Form::close() !!}
		</div>
		<!-- for editing password or account information -->
		<div class="tab-content editForm" id="editAccountForm" style="display: none;">
			
			This is for account edit 

		</div>
		<div class="clearfix"></div>
	</div>
@endif

@endsection


@section("scripts")

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
	var removePhoto = '{{route("profile.removePhoto")}}'
</script>


@endsection