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
						<img src="{{asset('images/load1.gif')}}" id="loading">
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
			{!! Form::model($user,["method"=>"POST","files"=>"true"]) !!}
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
				@can("doctor_related",$account)
				<div class="form-elements input-group">
					{!! Form::label("specialization","Your specialization",["class"=>"form-labels"]) !!}
					<a href="javascrip:void(0)" onclick="showTags()" id="addTagLink">
						<span id="tagsCount" class="badge badge-pill badge-light">{{$user->fields()->count()}}</span> &nbsp;
						Select Your specialized field
					</a>
					<span class="ErrorMessage  mb-2" id="tagsErrorMessage">
						@error('tags')
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
	var removePhoto = '{{route("profile.removePhoto")}}';
	var uploadPhoto = '{{route("profile.uploadPhoto")}}'
</script>


@endsection