<!-- advertisements add form -->
<button class="btn  btn-sm" id="showFormButton" onclick="showAdsDiv()">Add advertisement</button>
<div id="adsFormDiv" class="AddUpdateForm">
	@if(session("ads_success"))
		<div class="alert alert-success alert-sm ads-messages">
			<button class="close ach-close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
			{{session("ads_success")}}
		</div>
	@endif
	@if($errors->has('ads_title') || $errors->has('ads_content') || $errors->has('ads_year') || $errors->has('ads_month')|| $errors->has('ads_day')|| $errors->has('ads_photo'))
		<div class="alert alert-danger alert-sm ads-messages">
			<button class="close ach-close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
			OOps you commited a mistake. check bellow and try again!
		</div>
	@endif
	<span class="far fa-times float-right mr-2" id="ads-close-icon" title="close the form" onclick="closeAds()"></span>
	<h5 class="text-center">Add Advertisements</h5>
	{!! Form::open(["method"=>"POST","action"=>"Admin\AdvertisementController@store","files"=>"true"]) !!}
		<div class="ads-form-elements">
			{!! Form::label("ads_title","Title *",["class"=>"ads-formlabels"]) !!}
			<small class="ads-form-elements-descriptions">Write title for advertisement</small>
			{!! Form::text("ads_title",null,["class"=>"form-control ads-form-fields ".($errors->has('ads_title') ? ' ads-errors-messages' : ''),"maxlength"=>"100","onkeyup"=>"validateAdsContentEnableButton1()","id"=>"ads_title","placeholder"=>"e.g. job vacancy at ABC hospital"]) !!}
			<div class="ads-errors" id="adsTitleError">
				@error("ads_title")
					{{ $message }}
				@enderror
			</div>
		</div>
		<div class="ach-form-elements">
			{!! Form::label("ads_content","Description *",["class"=>"ads-formlabels"]) !!}
			<small class="ads-form-elements-descriptions">Write down short description of 500 chars about the advertisement</small>
			{!! Form::textarea("ads_content",null,["class"=>"form-control ads-form-fields ".($errors->has('ads_content') ? ' ads-errors-messages' : ''),"onkeyup"=>"validateAdsContentEnableButton2()", "id"=>"ads-textarea","maxlength"=>"500","rows"=>"4" ,"id"=>"ads_content" ,"placeholder"=>"e.g. the employee should have atleast 2 years of experiance."]) !!}
			<div class="ads-errors" id="adsContentError">
				@error("ads_content")
					{{ $message }}
				@enderror
			</div>
		</div>
		<div class="ach-form-elements">
			{!! Form::label("ads_category","Category *",["class"=>"ads-formlabels"]) !!}
			<small class="ads-form-elements-descriptions">Choose the advertisement category</small>
			{!! Form::select("ads_category",$ads_cat,null,["class"=>"form-control ads-form-fields ".($errors->has('ads_category') ? ' ads-errors-messages' : ''), "id"=>"ads-textarea","maxlength"=>"500","rows"=>"4" ,"id"=>"ads_category" ,"placeholder"=>"choose category *"]) !!}
			<div class="ads-errors" id="adsCategoryError">
				@error("ads_category")
					{{ $message }}
				@enderror
			</div>
		</div>
		<div class="ach-form-elements">
			{!! Form::label("ads_expire_date","Expire Date *",["class"=>"ads-formlabels"]) !!}
			<small class="ads-form-elements-descriptions">Specify the expire  date for advertisement</small>
			<div class="ads-errors" id="adsLocationError">
				@error("ads_year") {{ $message }} @enderror
				@error("ads_month") {{ $message }} @enderror
				@error("ads_day") {{ $message }} @enderror
			</div>
			<div class="row" id="ads-date-row">
				{!! Form::selectRange("ads_year",\Carbon\carbon::now()->format("Y"),\Carbon\carbon::now()->format("Y")+2,null,["class"=>"form-control ads-date-fields"]) !!}
				{!! Form::selectMonth("ads_month",null,["class"=>"form-control ads-date-fields"]) !!}
				{!! Form::selectRange("ads_day",1,31,null,["class"=>"form-control ads-date-fields"]) !!}
				@error("ads_year") {{ $message }} @enderror
				@error("ads_month") {{ $message }} @enderror
				@error("ads_day") {{ $message }} @enderror
			</div>
		</div>
		<div class="ads-form-elements">
			{!! Form::label("ads_photo","photo *",["class"=>"ads-formlabels"]) !!}
			<small class="ads-form-elements-descriptions">Add a photo to advertisemnt</small>
			<div class="ads-errors" id="adsPhotoError">
				@error("ads_photo")
					{{ $message }}
				@enderror
			</div>
			{!! Form::file("ads_photo",["class"=>"form-control ads-form-fields","onchange"=>"showAndValidateAdsFile()" ,"id"=>"adsPhotoField","disabled"=>"true","style"=>"display:none;"]) !!}
			<div class="ads-ImageDiv" id="ads-imageDiv">
				<button class="close ads-removeImage" onclick="removeAdsImage()" >
					&times; 
					<span class="ads-removeImageText"> Remove photo</span>
				</button>
				<a href="javascript:void(0)" class="fal fa-edit ml-2" id="ads-editIcon" onclick="openAdsPhotoField()">
					<span class="ads-addAchButtonDiv ads-removeImageText">Change photo</span>
				</a>
				<div class="text-center" style="overflow: hidden;">
					<img src="" id="adsPhotoPlaceHolder" >
				</div>
			</div>
			<a href="javascript:void(0)" id="ads-photo-icon" onclick="openAdsPhotoField()"><span class="far fa-image" id="" ></span></a>
		</div>
		<div class="dropdown-divider"></div>
		<div class="ach-form-elements" id="ads-buttons-div">
			<div class="float-right cancelSubmitButtonDiv">
				{!! Form::submit("Add achievement",["class"=>"btn btn-sm ads-buttons","onclick"=>"validateAdsForm()","id"=>"ads_submit","title"=>"Add Advertisement. First need to fill all the form fields"]) !!}
				<span class="far fa-arrow-right ads-icons" id="submitButtonIcon"></span>
			</div>
			<div  class="cancelSubmitButtonDiv">
				<span class="far fa-arrow-left ads-icons" id="cancelButtonIcon"></span>
				{!! Form::reset("Cancel",["class"=>"btn btn-sm ads-buttons","id"=>"resetAdsForm","title"=>"close and reset the form","onclick"=>"closeAds()"]) !!}
			</div>
		</div>
	{!! Form::close() !!}
</div>



<!-- advertisements update form -->
<div id="adsUpdateormDiv" class="AddUpdateForm" style="position: relative;">
	<img src="{{asset('images/load.gif')}}" id="updateLoad">
	@if($errors->has('ads_update_title') || $errors->has('ads_update_content') || $errors->has('ads_update_year') || $errors->has('ads_update_month')|| $errors->has('ads_update_day')|| $errors->has('ads_update_photo'))
		<div class="alert alert-danger alert-sm ads-messages">
			<button class="close ach-close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
			OOps you commited a mistake. check bellow and try again!
		</div>
	@endif
	@if(session('ads_update_error'))
		<div class="alert alert-danger alert-sm ads-messages">
			<button class="close ach-close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
			{{ session('ads_update_error') }}
		</div>
	@endif
	<span class="far fa-times float-right mr-2" id="ads-close-icon" title="close the form" onclick="closeAdsUpdate()"></span>
	<h5 class="text-center">Edit Advertisements</h5>
	{!! Form::open(["method"=>"PUT","action"=>"Admin\AdvertisementController@update","files"=>"true"]) !!}
		<div class="ads-form-elements">
			{!! Form::label("ads_update_title","Title *",["class"=>"ads-formlabels"]) !!}
			<small class="ads-form-elements-descriptions">Write title for advertisement</small>
			{!! Form::text("ads_update_title",null,["class"=>"form-control ads-form-fields ".($errors->has('ads_update_title') ? ' ads-errors-messages' : ''),"maxlength"=>"100","onkeyup"=>"validateAdsUpdateContentEnableButton1()","id"=>"ads_update_title","placeholder"=>"e.g. job vacancy at ABC hospital"]) !!}

			<div class="ads-errors" id="adsTitleUpdateError">
				@error("ads_update_title")
					{{ $message }}
				@enderror
			</div>
		</div>
		<div>
			{!! Form::hidden("id",null,["id"=>"ads_update_id"]) !!}
		</div>
		<div class="ach-form-elements">
			{!! Form::label("ads_update_content","Description *",["class"=>"ads-formlabels"]) !!}
			<small class="ads-form-elements-descriptions">Write down short description of 500 chars about the advertisement</small>
			{!! Form::textarea("ads_update_content",null,["class"=>"form-control ads-form-fields ".($errors->has('ads_update_content') ? ' ads-errors-messages' : ''),"onkeyup"=>"validateAdsUpdateContentEnableButton2()","maxlength"=>"500","rows"=>"4" ,"id"=>"ads_update_content" ,"placeholder"=>"e.g. the employee should have atleast 2 years of experiance."]) !!}
			<div class="ads-errors" id="adsContentUpdateError">
				@error("ads_update_content")
					{{ $message }}
				@enderror
			</div>
		</div>
		<div class="ach-form-elements">
			{!! Form::label("ads_update_category","Category *",["class"=>"ads-formlabels"]) !!}
			<small class="ads-form-elements-descriptions">Choose the advertisement category</small>
			{!! Form::select("ads_update_category",$ads_cat,null,["class"=>"form-control ads-form-fields ".($errors->has('ads_update_category') ? ' ads-errors-messages' : ''), "id"=>"ads-textarea","maxlength"=>"500","rows"=>"4" ,"id"=>"ads_update_category" ,"placeholder"=>"choose category *"]) !!}
			<div class="ads-errors" id="adsCategoryUpdateError">
				@error("ads_update_category")
					{{ $message }}
				@enderror
			</div>
		</div>
		<div class="ach-form-elements">
			{!! Form::label("ads_update_update_expire_date","Expire Date *",["class"=>"ads-formlabels"]) !!}
			<small class="ads-form-elements-descriptions">Specify the expire  date for advertisement</small>
			<div class="ads-errors" id="adsLocationUpdateError">
				@error("ads_update_year") {{ $message }} @enderror
				@error("ads_update_month") {{ $message }} @enderror
				@error("ads_update_day") {{ $message }} @enderror
			</div>
			<div class="row" id="ads-date-row">
				{!! Form::selectRange("ads_update_year",\Carbon\carbon::now()->format("Y"),\Carbon\carbon::now()->format("Y")+2,null,["class"=>"form-control ads-date-fields","id"=>"ads_update_year"]) !!}
				{!! Form::selectMonth("ads_update_month",null,["class"=>"form-control ads-date-fields","id"=>"ads_update_month"]) !!}
				{!! Form::selectRange("ads_update_day",1,31,null,["class"=>"form-control ads-date-fields" ,"id"=>"ads_update_day"]) !!}
				@error("ads_update_year") {{ $message }} @enderror
				@error("ads_update_month") {{ $message }} @enderror
				@error("ads_update_day") {{ $message }} @enderror
			</div>
		</div>
		<div class="ads-form-elements">
			{!! Form::label("ads_update_photo","photo *",["class"=>"ads-formlabels"]) !!}
			<small class="ads-form-elements-descriptions">Add a photo to advertisemnt</small>
			<div class="ads-errors" id="adsPhotoUpdateError">
				@error("ads_update_photo")
					{{ $message }}
				@enderror
			</div>
			{!! Form::file("ads_update_photo",["class"=>"form-control ads-form-fields","onchange"=>"showAndValidateAdsUpdateFile()" ,"id"=>"adsUpdatePhotoField","disabled"=>"true","style"=>"display:none;"]) !!}
			<div class="ads-ImageDiv" id="ads-update-imageDiv">
			
				<a href="javascript:void(0)" class="fal fa-edit ml-2" id="ads-editIcon" onclick="openAdsUpdatePhotoField()">
					<span class="ads-addAchButtonDiv ads-removeImageText">Change photo</span>
				</a>
				<div class="text-center" style="overflow: hidden;">
					<img src="" id="adsPhotoUpdatePlaceUpdateHolder" >
				</div>
			</div>
			<a href="javascript:void(0)" id="ads-photo-icon" onclick="openAdsUpdatePhotoField()"><span class="far fa-image" id="" ></span></a>
		</div>
		<div class="dropdown-divider"></div>
		<div class="ach-form-elements" id="ads-buttons-div">
			<div class="float-right cancelSubmitButtonDiv">
				{!! Form::submit("Update achievement",["class"=>"btn btn-sm ads-buttons","onclick"=>"validateAdsUpdateForm()","id"=>"ads_update_submit","title"=>"Update Advertisement. First need to fill all the form fields"]) !!}
				<span class="far fa-arrow-right ads-icons" id="submitButtonIcon"></span>
			</div>
			<div  class="cancelSubmitButtonDiv">
				<span class="far fa-arrow-left ads-icons" id="cancelButtonIcon"></span>
				{!! Form::reset("Cancel",["class"=>"btn btn-sm ads-buttons","id"=>"resetAdsUpdateForm","title"=>"close and reset the form","onclick"=>"closeAdsUpdate()"]) !!}
			</div>
		</div>
	{!! Form::close() !!}
</div>
