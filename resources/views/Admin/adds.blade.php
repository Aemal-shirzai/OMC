@extends("../layouts.MainLayout")

@section("title","Admin Panel Advertisements")

@section("content")
@include("../layouts.adminLayout")

<div id="main">
	<!-- advertisements readmore div -->
	<div id="readmorediv">
		<div id="closeButtonReadmore"  class="far fa-times float-right" onclick="closeReadMore()"></div>
		<div id="readmoreHeading">
			
		</div>
		<div id="readmoredivContent">
			
		</div>
		<img src="{{asset('images/load1.gif')}}" id="readmoreLoad">
	</div>

	<img src="{{asset('images/load.gif')}}" id="deleteLoad">

	<!-- Category add Form -->
	<div class="formDiv" id="cFormDivAdd">
		<div class="closeFormButton" onclick="closeForm('Cadd')"><span class="far fa-times"></span></div>
		{!! Form::open(["method"=>"POST","action"=>"Admin\AdvertisementController@storeAdsCat","id"=>"adsCategoryAddForm"]) !!}
			<div class="form-elemets">
				{!! Form::label("category","Add Ads Cateogry",["class"=>"form-labels"]) !!}
				{!! Form::text("category",null,["class"=>"form-control ".($errors->has('category') ? ' errorForm' : ''),"placeholder"=>"category name ... ","autocomplete"=>"off", "id"=>"formField","maxlength"=>"60"]) !!}
				<img src="{{asset('images/load.gif')}}" class="addLoad">
				<div class="errors">
					@error("category")
						{{$message}}
					@enderror
				</div>
				<div class="done" style="color: green; font-size: 12px;">
					@if(session('catSuccess'))
						{{session('catSuccess')}}
					@endif
				</div>
				<span class="notes">Duplicate category names are ingnored!</span>
			</div>
			<div class="form-elemets">
				{!! Form::submit("Add",["class"=>"btn btn-sm submitButton","id"=>"submitButtonAddCat"]) !!}
			</div>
		{!! form::close() !!}
	</div>

		<!-- Category update Form -->
	<div class="formDiv" id="cFormDivUpdate">
		<div class="closeFormButton" onclick="closeForm('Cupdate')"><span class="far fa-times"></span></div>
		{!! Form::open(["method"=>"PUT","action"=>"Admin\DcategoryController@update","id"=>"adsCategoryUpdateForm"]) !!}
			<div class="form-elemets">
				{!! Form::label("category","Update Doctor Cateogry",["class"=>"form-labels"]) !!}
				{!! Form::text("category",null,["class"=>"form-control ".($errors->has('category') ? ' errorForm' : ''),"placeholder"=>"category name ... ","autocomplete"=>"off", "id"=>"formFieldUpdate"]) !!}
				{!! Form::hidden("cat_id",null,["id"=>"cat_id"]) !!}
				<img src="{{asset('images/load.gif')}}" class="addLoad">
				<div class="errors">
					@error("category")
						{{$message}}
					@enderror
				</div>
				<div class="done" style="color: green; font-size: 12px;">
					
				</div>
				<span class="notes">Duplicate names are ingnored!</span>
			</div>
			<div class="form-elemets">
				{!! Form::submit("Update",["class"=>"btn btn-sm submitButton","id"=>"submitButtonUpdateCat"]) !!}
				<a href="javascript:void(0)" class="btn btn-sm submitButton" id="DeleteCatButton" onclick="openMessageConfirmation()">Delete</a>
			</div>
		{!! form::close() !!}
	</div>

	<!-- ads category -->
	<div class="card" id="adsCategory">

		<div class="card-header"  id="adsCategoryHeading" >
			<h4>Advertisements Categories</h4>
			<a href="javascript:void(0)" id="addAdsCatButton" class="btn btn-primary" onclick="openAddCatForm()"><span class="far fa-plus"></span></a>
			<span class="far fa-chevron-down" id="openCatIcon" onclick="openCatList()"></span>
		</div>
		<div class="card-body" id="adsCategoryContent">
			@if(count($categories) > 0)
				@foreach($categories as $category)
					<a href="javascript:void(0)" class="categories" id="row-{{$category->id}}" onclick="openUpdateForm('{{$category->id}}')">
						<button class="close"><span class="far fa-edit"></span></button> 
						{{$category->category}}
					</a>

					<div class="confirmationBox" id="messageConfirmationBox-{{$category->id}}">
						<div class="text">Are You Sure To Delete?</div>
						<div class="text"><small>Remember: There is no comeback</small></div>
						<a href="javascript:void(0)" onclick="deleteMessages('{{$category->id}}')" class="btn btn-danger btn-sm">Delete</a>
						<a href="javascript:void(0)" onclick="messageClosePermissionBox('{{$category->id}}')" class="btn btn-light btn-sm">Cancel</a>
					</div>
				@endforeach
			@else
				<h4 id="noCategory">No category for advertisements!</h4>
			@endif
		</div>
	</div>

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
					@error("ads_content")
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
					{!! Form::reset("Cancel",["class"=>"btn btn-sm ads-buttons","id"=>"resetAdsForm","title"=>"close and reset the form","onclick"=>"closeAch()"]) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>

	<!-- advertisements update form -->
	<div id="adsUpdateormDiv" class="AddUpdateForm">
		@if(session("ads_update_success"))
			<div class="alert alert-success alert-sm ads-messages">
				<button class="close ach-close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
				{{session("ads_update_success")}}
			</div>
		@endif
		@if($errors->has('ads_update_title') || $errors->has('ads_update_content') || $errors->has('ads_update_year') || $errors->has('ads_update_month')|| $errors->has('ads_update_day')|| $errors->has('ads_update_photo'))
			<div class="alert alert-danger alert-sm ads-messages">
				<button class="close ach-close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
				OOps you commited a mistake. check bellow and try again!
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
					@error("ads_update_content")
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
					{!! Form::submit("Update achievement",["class"=>"btn btn-sm ads-buttons","onclick"=>"validateAdsFor()","id"=>"ads_update_submit","title"=>"Update Advertisement. First need to fill all the form fields"]) !!}
					<span class="far fa-arrow-right ads-icons" id="submitButtonIcon"></span>
				</div>
				<div  class="cancelSubmitButtonDiv">
					<span class="far fa-arrow-left ads-icons" id="cancelButtonIcon"></span>
					{!! Form::reset("Cancel",["class"=>"btn btn-sm ads-buttons","id"=>"resetAdsUpdateForm","title"=>"close and reset the form","onclick"=>"closeAdsUpdate()"]) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>
	
	<!-- Advertisemtn content -->
	<div id="ads_content_div">
		@if(count($ads)>0)
			@foreach($ads as $ad)
				<div class="ads" id="ads-{{$ad->id}}">
					<div class="imageDiv">
					@if($ad->photos()->where('status',1)->first())
						<img src="/Storage/images/advertisements/{{$ad->photos()->where('status',1)->first()->path}}" id="adsImage">
						
					@else
						<h4 class="text-center" id="noImage">No Image</h4>
					@endif
					</div>
					<div class="title">
						<h4>{{$ad->title}}</h4>
					</div>
					<div class="content">
						@if(strlen($ad->content) > 200)
						<p>{{Str::limit($ad->content,200)}} <a href="#" class="readmore" onclick="readMore('{{$ad->id}}')">read more...</a></p>
						@else
						<p>{{$ad->content}}</p>
						@endif
						<div class="details">
							<a href="javascript:void(0)" class="" onclick="loadEditData('{{$ad->id}}')"><span class="far fa-edit"></span></a>
							<a href="javascript:void(0)" onclick="showAdsDeleteConfirmation('{{$ad->id}}')" id="deleteAdsIcon-{{$ad->id}}"><span class="far fa-trash"></span></a>
							<a class="" href="javascript:void(0)" onclick="toggleDetails('{{$ad->id}}')">Details</a>
						</div>
					</div>
					<!-- advertisements options -->
					<div class="ads-details" id="ads-details-{{$ad->id}}">
						<div class="far fa-times float-right detailsCloseButton" onclick="toggleDetails('{{$ad->id}}')"></div>
						<a href="{{route('profile',$ad->createdBy)}}" class="by">* created by {{$ad->createdBy}}</a>
						@if($ad->updatedBy)
							<a href="{{route('profile',$ad->createdBy)}}" class="by">* updated by {{$ad->createdBy}}</a>
						@else
							<a>* Not Updated Yet!</a>
						@endif
					</div>
				</div>
				<div class="confirmationBox" id="adsConfirmationBox-{{$ad->id}}">
					<div class="text">Are You Sure To Delete?</div>
					<div class="text"><small>Remember: There is no comeback</small></div>
					<a href="javascript:void(0)" onclick="deleteAds('{{$ad->id}}')" class="btn btn-danger btn-sm">Delete</a>
					<a href="javascript:void(0)" onclick="closeAdsDeleteConfirmation('{{$ad->id}}')" class="btn btn-light btn-sm">Cancel</a>
				</div>
			@endforeach
		@else
			<h4 id="noAds">No Advertisements to display</h4>
		@endif
	</div>

</div>

@endsection



@section("scripts")

	@if(session('ads_success') || $errors->has('ads_title') || $errors->has('ads_content') || $errors->has('ads_category') || $errors->has('ads_year') || $errors->has('ads_month')|| $errors->has('ads_day')|| $errors->has('ads_photo'))
		<script type="text/javascript">
			$("#adsFormDiv").show();
		</script>
	@endif


<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';
		var adCatStore = '{{ route("ads.category.store") }}';
		var adCatEdit = '{{ route("ads.category.edit") }}';
		var adCatUpdate = '{{ route("ads.category.update") }}';
		var adCatDelete = '{{ route("ads.category.delete") }}';
		var readFull = '{{ route("ads.readMore") }}';
		var adsDelete = '{{ route("ads.delete") }}';
		var adsEdit = '{{ route("ads.edit") }}';
	</script>
@endsection