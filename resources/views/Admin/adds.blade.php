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
	@include("admin.adsForms.addUpdateForms")
	<!-- Advertisemtn content -->
	<div id="ads_content_div">
		@if(session("ads_update_success"))
			<div class="alert alert-success alert-sm ads-messages">
				<button class="close ach-close" data-dismiss="alert" area-hidden="true"><span class="fal fa-times"></span></button>
				{{session("ads_update_success")}}
			</div>
		@endif
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
						<a>*Category: {{$ad->category->category}}</a>
						<a>*Expire Date: {{$ad->expire_date}}</a>
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
	@if(session('ads_update_error') || $errors->has('ads_update_title') || $errors->has('ads_update_content') || $errors->has('ads_update_category') || $errors->has('ads_update_year') || $errors->has('ads_update_month')|| $errors->has('ads_update_day')|| $errors->has('ads_update_photo'))
		<script type="text/javascript">
			$("#adsUpdateormDiv").show();
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