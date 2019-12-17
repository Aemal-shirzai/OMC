@extends("../layouts.MainLayout")

@section("title","Admin Panel Doctor Categories")

@section("content")
@include("../layouts.adminLayout")
<div id="main">
	<img src="{{asset('images/load.gif')}}" id="deleteLoad">
	<div id="deleteMessage" class="alert alert-success alert-sm" style="{{(session('success') ? 'display: block' : '')}}">
		<button class="close"  data-dismiss="alert"><span class="far fa-times"></span></button>
		<span id="messages">
			{{session('success')}}
		</span>
	</div>
	<div id="addCatButton" title="Add category" onclick="openForm()">
		<span class="far fa-plus"></span>
	</div>
	<!-- Category Form -->
	<div id="formDiv">
		<div   id="closeFormButton" onclick="closeForm()"><span class="far fa-times"></span></div>
		{!! Form::open(["method"=>"POST","action"=>"Admin\AdminController@storeCategories","id"=>"dCategoryAddForm"]) !!}
			<div class="form-elemets">
				{!! Form::label("category","Add Doctor Cateogry",["class"=>"form-labels"]) !!}
				{!! Form::text("category",null,["class"=>"form-control ".($errors->has('category') ? ' errorForm' : ''),"placeholder"=>"category name ... ","autocomplete"=>"off", "id"=>"formField"]) !!}
				<img src="{{asset('images/load.gif')}}" id="addLoad">
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
				{!! Form::submit("Add",["class"=>"btn btn-sm","id"=>"submitButton"]) !!}
			</div>
		{!! form::close() !!}
	</div>
	<div id="catList">
			<div class="table-responsive">
				{!! Form::open(["method"=>"DELETE","action"=>"Admin\AdminController@deleteCategories","id"=>"deleteCatForm"]) !!}
				<button class="btn btn-sm" id="deleteCatButton"><span class="fal fa-trash "></span></button>
				<table class="table table-bordered" id="dcatTable">
					<thead id="catTableHead">
						<tr>
							<th>Id</th>
							<th>Category</th>
							<th>Registered</th>
							<th>C.by</th>
							<th>U.by</th>
							<th>Created</th>
							<th>Updated</th>
							<th>Edit</th>
							<th>{!! Form::checkbox("all",null,null,["id"=>"chooseAll","onclick"=>"showDeleteButtonAll()	"]) !!}</th>
						</tr>
					</thead>
					<tbody id="catTableBody">
						@if(count($dcategories) > 0)
						<h4>All Doctors Categories</h4>
						@foreach($dcategories as $dcategory)
							<tr id="row-{{$dcategory->id}}">
								<td>{{$dcategory->id}}</td>
								<td>{{$dcategory->category}}</td>
								<td>{{$dcategory->doctors()->count()}}</td>
								<td>
									@if($dcategory->createdBy)
										<a href="{{route('profile',$dcategory->createdBy)}}" >
											{{$dcategory->createdBy}}
										</a>
									@else
										{{$dcategory->createdBy}}
									@endif
								</td>
								<td>{{$dcategory->updatedBy}}</td>
								<td>{{$dcategory->created_at->format("Y-M-d")}}</td>
								<td>{{$dcategory->updated_at->format("Y-M-d")}}</td>
								<td><a href="#" class="fal fa-edit"></a></td>
								<td style="position: relative;">
									{!! Form::checkbox("catIds[]",$dcategory->id,null,["class"=>"one_by_one","id"=>"checkBox-$dcategory->id","onclick"=>"showDeleteButtonSingle()"]) !!}
								</td>
							</tr>
						@endforeach
						@else
							<h4>No Doctor Fields Yet!</h4>
						@endif
					</tbody>
				</table>
				{!! Form::close() !!}
			</div>
			{{$dcategories->links()}}
	</div>
	<!-- categories list div end -->
	<div class="clearfix"></div>
</div> 
<!-- Main div end -->
@endsection


<!-- <div id="catForm">
		{!! Form::open(["id"=>"dcategoryForm"]) !!}
			<div class="form_elements">
				{!! Form::label("category","Add Doctor Category") !!}
				{!! Form::text("category",null,["class"=>"form-control","placeholder"=>"Category name"]) !!}
			</div>
			<div class="form_elements">
				{!! Form::submit("Add Category",["class"=>"btn btn-sm","id"=>"submitButton"]) !!}
			</div>
		{!! Form::close() !!}
	</div> -->
	<!-- categories form div end -->

@section("scripts")


<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';
		var dcategoryDelete = '{{route("dcategories.delete")}}';
		var storeCategories = '{{route("dcategories.store")}}';
	</script>
@endsection