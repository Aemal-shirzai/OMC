@extends("../layouts.mainLayout")
@section("title","Achievements edit")

@section("content")
<div id="achParent">
	<div class="confirmationBox" id="achConfirmationBox">
		<div id="text">Are You Sure To Delete?</div>
		<div id="text"><small>Remember: There is no comeback</small></div>
		<a href="javascript:void(0)" onclick="deleteAch('{{$ach->id}}')" class="btn btn-danger btn-sm">Delete</a>
		<a href="javascript:void(0)" onclick="achClosePermissionBox()" class="btn btn-light btn-sm">Cancel</a>
	</div>
	<div id="addAchButtonDiv">
		<a  href="{{route('profile',Auth::user()->username)}}" class="btn btn-sm addAchButton"><span class="far fa-arrow-left"></span> Go Back</a>
		<a href="javascript:void(0)" id="delAchButton" class="btn btn-sm addAchButton" onclick="openAchPermission()">
			<span class="far fa-trash" id="delButtonIcon"></span> 
			<span id="delButtonText">Delete</span>
			<img src="{{asset('images/load1.gif')}}" style="width: 16px;margin-left: 5px;display: none;" id="achDeleteLoad"> 
		</a>
	</div>
	<!-- sccess dete message -->
	<div class="alert alert-success alert-sm ach-messages" style="display: none;" id="achDeleteMesssage">
		<button class="close ach-close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
		Achiemement Deleted!
	</div>
	<!-- ach form -->
	<div id="achFormDiv">
		@if(session("ach_success"))
			<div class="alert alert-success alert-sm ach-messages">
				<button class="close ach-close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
				{{session("ach_success")}}
			</div>
		@endif
		@if($errors->has('ach_title') || $errors->has('ach_content') || $errors->has('ach_location') || $errors->has('ach_year') || $errors->has('ach_month')|| $errors->has('ach_day')|| $errors->has('ach_photo'))
			<div class="alert alert-danger alert-sm ach-messages">
				<button class="close ach-close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
				OOps you commited a mistake. check bellow and try again!
			</div>
		@endif
		<h5 class="text-center">Edit Achievements</h5>
		{!! Form::model($ach,["method"=>"PUT","action"=>["DoctorController@achUpdate",$ach->id],"files"=>"true"]) !!}
			<div class="ach-form-elements">
				{!! Form::label("ach_title","Title *",["class"=>"ach-formlabels"]) !!}
				<small class="ach-form-elements-descriptions">Be specific while adding the title for achievements</small>
				{!! Form::text("ach_title",null,["class"=>"form-control ach-form-fields ".($errors->has('ach_title') ? ' ach-errors-messages' : ''),"maxlength"=>"100","onkeyup"=>"validateAchContentEnableButton1()","id"=>"ach_title","placeholder"=>"e.g. Annual Congress on Diabetes and Endocrinology Certificate"]) !!}
				<div class="ach-errors" id="achTitleError">
					@error("ach_title")
						{{ $message }}
					@enderror
				</div>
			</div>
			<div class="ach-form-elements">
				{!! Form::label("ach_content","Discription *",["class"=>"ach-formlabels"]) !!}
				<small class="ach-form-elements-descriptions">Write down short notes of 500 chars about the achievment</small>
				{!! Form::textarea("ach_content",null,["class"=>"form-control ach-form-fields ".($errors->has('ach_content') ? ' ach-errors-messages' : ''),"onkeyup"=>"validateAchContentEnableButton2()", "id"=>"ach-textarea","maxlength"=>"500","rows"=>"4" ,"id"=>"ach_content" ,"placeholder"=>"e.g. Diabetes & Endocrinology Conference was held on the theme of To Collection of Innovative treatments involved in Endocrinology and Diabetes."]) !!}
				<div class="ach-errors" id="achContentError">
					@error("ach_content")
						{{ $message }}
					@enderror
				</div>
			</div>
			<div class="ach-form-elements">
				{!! Form::label("location","location *",["class"=>"ach-formlabels"]) !!}
				<small class="ach-form-elements-descriptions">Where you got this achievment</small>
				{!! Form::text("ach_location",null,["class"=>"form-control ach-form-fields mapControls ".($errors->has('ach_location') ? ' ach-errors-messages' : '') ,"id"=>"ach_location","onkeyup"=>"validateAchContentEnableButton3()", "maxlength"=>"100","placeholder"=>"e.g. Kabul, Afghanistan "]) !!}
				<div class="ach-errors" id="achLocationError">
					@error("ach_location")
						{{ $message }}
					@enderror
				</div>
			</div>
			<div class="ach-form-elements">
				{!! Form::label("ach_date","Date *",["class"=>"ach-formlabels"]) !!}
				<small class="ach-form-elements-descriptions">Specify the date in which you got this achiement</small>
				<div class="ach-errors" id="achLocationError">
					@error("ach_year") {{ $message }} @enderror
					@error("ach_month") {{ $message }} @enderror
					@error("ach_day") {{ $message }} @enderror
				</div>
				<div class="row" id="ach-date-row">
					{!! Form::selectRange("ach_year",1950,\Carbon\carbon::now()->format("Y"),null,["class"=>"form-control ach-date-fields"]) !!}
					{!! Form::selectMonth("ach_month",null,["class"=>"form-control ach-date-fields"]) !!}
					{!! Form::selectRange("ach_day",1,31,null,["class"=>"form-control ach-date-fields"]) !!}
					@error("ach_year") {{ $message }} @enderror
					@error("ach_month") {{ $message }} @enderror
					@error("ach_day") {{ $message }} @enderror
				</div>
			</div>
			<div class="ach-form-elements">
				{!! Form::label("ach_photo","photo *",["class"=>"ach-formlabels"]) !!}
				<small class="ach-form-elements-descriptions">Add a photo to prove the validity of achivements</small>
				<div class="ach-errors" id="achPhotoError">
					@error("ach_photo")
						{{ $message }}
					@enderror
				</div>
				{!! Form::file("ach_photo",["class"=>"form-control ach-form-fields","onchange"=>"showAndValidateAchFile()" ,"id"=>"achPhotoField","disabled"=>"true","style"=>"display:none;"]) !!}

				@if($ach->photos()->where('status',1)->first())
				<div class="ach-ImageDiv" id="ach-imageDiv">
					<!-- <button class="close ach-removeImage" onclick="removeAchImage()" >
						&times; 
						<span class="ach-removeImageText"> Remove photo</span>
					</button> -->
					<a href="javascript:void(0)" class="fal fa-edit ml-2" id="ach-editIcon" onclick="openAchPhotoField()">
						<span class="ach-removeImageText">Change photo</span>
					</a>
					<div class="text-center" style="overflow: hidden;">
						<img src="/Storage/images/achievements/{{$ach->photos()->where('status',1)->first()->path}}" id="achPhotoPlaceHolder" >
					</div>

				</div>
				@endif
				<a href="javascript:void(0)" id="ach-photo-icon" onclick="openAchPhotoField()"><span class="far fa-image" id="" ></span></a>
			</div>
			<div class="dropdown-divider"></div>
			<div class="ach-form-elements" id="ach-buttons-div">
				<div class="float-right cancelSubmitButtonDiv">
					{!! Form::submit("Update achievement",["class"=>"btn btn-sm ach-buttons","onclick"=>"validateAchForm()","id"=>"ach_submit","title"=>"Add achiemvents. First need to fill all the form fields"]) !!}
					<span class="far fa-arrow-right ach-icons" id="submitButtonIcon"></span>
				</div>
				<div class="clearfix"></div>
			</div>
		{!! Form::close() !!}
	</div>
	<!-- form div end -->
</div>

@endsection


@section("scripts")

<script type="text/javascript">
	var token = '{{ Session::token() }}';
	// This route is delete the achivments by dcotor
	var achDelete = '{{route("achDelete")}}';
</script>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUbaJ_k1aVM64WPjSVKod96VM-YoF7fsE&amp;libraries=places"></script>
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=place&key=AIzaSyCUbaJ_k1aVM64WPjSVKod96VM-YoF7fsE"></script> -->
         
<script>
  google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
      var input = document.getElementById('ach_location');
      var autocomplete = new google.maps.places.Autocomplete(input);
  }
</script>

@endsection