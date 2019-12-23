@extends("../layouts.MainLayout")

@section("title","Admin Panel Tags")

@section("content")
@include("../layouts.adminLayout")
<div id="main">

	<img src="{{asset('images/load.gif')}}" id="deleteLoad">
	<div id="deleteMessage" class="alert alert-success alert-sm text-center" style="{{(session('success') ? 'display: block' : '')}}">
		<button class="close"  data-dismiss="alert"><span class="far fa-times"></span></button>
		<span id="messages">
			{{session('success')}}
		</span>
	</div>
	<div id="addCatButton" title="Add category" onclick="openForm('Cadd')">
		<span class="far fa-plus"></span>
	</div>

	<!-- Category add Form -->
	<div class="formDiv" id="cFormDivAdd">
		<div class="closeFormButton" onclick="closeForm('Cadd')"><span class="far fa-times"></span></div>
		{!! Form::open(["method"=>"POST","action"=>"Admin\TagController@storeTags","id"=>"tagsAddForm"]) !!}
			<div class="form-elemets">
				{!! Form::label("category","Add Tags",["class"=>"form-labels"]) !!}
				{!! Form::text("category",null,["class"=>"form-control ".($errors->has('category') ? ' errorForm' : ''),"placeholder"=>"category name ... ","autocomplete"=>"off", "id"=>"formField"]) !!}
				<img src="{{asset('images/load.gif')}}" class="addLoad">
				<div class="errors">
					@error("category")
						{{$message}}
					@enderror
				</div>
				<div class="done" style="color: green; font-size: 12px;">
					
				</div>
				<span class="notes">Duplicate tags are ingnored!</span>
			</div>
			<div class="form-elemets">
				{!! Form::submit("Add",["class"=>"btn btn-sm submitButton","id"=>"submitButtonAdd"]) !!}
			</div>
		{!! form::close() !!}
	</div>

	<!-- Category update Form -->
	<div class="formDiv" id="cFormDivUpdate">
		<div class="closeFormButton" onclick="closeForm('Cupdate')"><span class="far fa-times"></span></div>
		{!! Form::open(["method"=>"PUT","action"=>"Admin\TagController@update","id"=>"tagsUpdateForm"]) !!}
			<div class="form-elemets">
				{!! Form::label("category","Update Doctor Cateogry",["class"=>"form-labels"]) !!}
				{!! Form::text("category",null,["class"=>"form-control ".($errors->has('category') ? ' errorForm' : ''),"placeholder"=>"category name ... ","autocomplete"=>"off", "id"=>"formFieldUpdate"]) !!}
				{!! Form::hidden("tag_id",null,["id"=>"tag_id"]) !!}
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
				{!! Form::submit("Update",["class"=>"btn btn-sm submitButton","id"=>"submitButtonUpdate"]) !!}
			</div>
		{!! form::close() !!}
	</div>
	<div id="catList">
			<div class="table-responsive">
				{!! Form::open(["method"=>"DELETE","action"=>"Admin\TagController@deleteTags","id"=>"deleteTagForm"]) !!}
				<button class="btn btn-sm" id="deleteCatButton"><span class="fal fa-trash "></span></button>
				<table class="table table-bordered" id="dcatTable">
					<thead id="catTableHead">
						<tr>
							<th>Id</th>
							<th>Category</th>
							<th>Registered P&Q</th>
							<th>C.by</th>
							<th>U.by</th>
							<th>Created</th>
							<th>Updated</th>
							<th>Edit</th>
							<th>{!! Form::checkbox("all",null,null,["id"=>"chooseAll","onclick"=>"showDeleteButtonAll()	"]) !!}</th>
						</tr>
					</thead>
					<tbody id="catTableBody">
						@if(count($tags) > 0)
						<h4>All Tags</h4>
						@foreach($tags as $tag)
							<tr id="row-{{$tag->id}}">
								<td>{{$tag->id}}</td>
								<td>{{$tag->category}}</td>
								<td>{{count($tag->posts) + count($tag->questions)}}</td>
								<td>
									@if($tag->createdBy)
										<a href="{{route('profile',$tag->createdBy)}}" >
											{{$tag->createdBy}}
										</a>
									@else
										{{$tag->createdBy}}
									@endif
								</td>
								<td>
									@if($tag->updatedBy)
										<a href="{{route('profile',$tag->createdBy)}}" >
											{{$tag->updatedBy}}
										</a>
									@else
										{{$tag->updatedBy}}
									@endif
								</td>
								<td>{{$tag->created_at->format("Y-M-d")}}</td>
								<td>{{$tag->updated_at->format("Y-M-d")}}</td>
								<td><a href="javascript:void(0)" class="fal fa-edit" onclick="openUpdateForm({!! $tag->id !!})"></a></td>
								<td style="position: relative;">
									{!! Form::checkbox("tagIds[]",$tag->id,null,["class"=>"one_by_one","id"=>"checkBox-$tag->id","onclick"=>"showDeleteButtonSingle()"]) !!}
								</td>
							</tr>
						@endforeach
						@else
							<h4>No Tags!</h4>
						@endif
					</tbody>
				</table>
				{!! Form::close() !!}
			</div>
			{{$tags->links()}}
	</div>
	<!-- categories list div end -->
	<div class="clearfix"></div>
</div> 
<!-- Main div end -->
@endsection



@section("scripts")


<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';
		var tagsDelete = '{{route("tags.delete")}}';
		var storeTags = '{{route("tags.store")}}';
		var editTags = '{{route("tags.edit")}}';
		var updateTags = '{{route("tags.update")}}';
	</script>
@endsection