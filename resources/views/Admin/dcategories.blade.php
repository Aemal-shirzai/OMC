@extends("../layouts.MainLayout")

@section("title","Admin Panel Doctor Categories")

@section("content")
@include("../layouts.adminLayout")
<div id="main">
	<img src="{{asset('images/load.gif')}}" id="deleteLoad">
	<div id="deleteMessage" class="alert alert-success alert-sm">
		<button class="close"  data-dismiss="alert"><span class="far fa-times"></span></button>
		Deleted
	</div>
	<div id="catList">
		@if(count($dcategories) > 0)
			<h4>All Doctors Categories</h4>
			<div class="table-responsive">
				{!! Form::open(["method"=>"DELETE","action"=>"Admin\AdminController@deleteCategories","id"=>"deleteCatForm"]) !!}
				<button class="btn btn-sm" id="deleteCatButton"><span class="fal fa-trash "></span></button>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Id</th>
							<th>Category</th>
							<th>Registered</th>
							<th>C.by</th>
							<th>U.by</th>
							<th>Created</th>
							<th>Updated</th>
							<th>Edit</th>
							<th>{!! Form::checkbox("all",null,null,["id"=>"chooseAll"]) !!}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($dcategories as $dcategory)
							<tr id="row-{{$dcategory->id}}">
								<td>{{$dcategory->id}}</td>
								<td>{{$dcategory->category}}</td>
								<td>{{$dcategory->doctors()->count()}}</td>
								<td>{{$dcategory->createdBy}}</td>
								<td>{{$dcategory->updatedBy}}</td>
								<td>{{$dcategory->created_at->format("Y-M-d")}}</td>
								<td>{{$dcategory->updated_at->format("Y-M-d")}}</td>
								<td><a href="#" class="fal fa-edit"></a></td>
								<td style="position: relative;">
									{!! Form::checkbox("catIds[]",$dcategory->id,null,["class"=>"one_by_one","id"=>"checkBox-$dcategory->id"]) !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{!! Form::close() !!}
			</div>
			{{$dcategories->links()}}
		@else
		<h4>No Doctor Fields Yet!</h4>
		@endif
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
	</script>
@endsection