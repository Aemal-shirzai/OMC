@extends("../layouts.MainLayout")

@section("title","Admin Panel Advertisements")

@section("content")
@include("../layouts.adminLayout")

<div id="main">
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
	<div id="adsAddForm">
		This is a form to add ads from by admin
	</div>
</div>

@endsection



@section("scripts")


<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';
		var adCatStore = '{{ route("ads.store") }}';
		var adCatEdit = '{{ route("ads.edit") }}';
		var adCatUpdate = '{{ route("ads.update") }}';
		var adCatDelete = '{{ route("ads.delete") }}';
	</script>
@endsection