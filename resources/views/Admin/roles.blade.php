@extends("../layouts.MainLayout")

@section("title","Admin Panel Roles")

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
		{!! Form::open(["method"=>"POST","action"=>"Admin\RoleController@storeRoles","id"=>"rolesAddForm"]) !!}
			<div class="form-elemets">
				{!! Form::label("role","Add Roles",["class"=>"form-labels"]) !!}
				{!! Form::text("role",null,["class"=>"form-control ".($errors->has('role') ? ' errorForm' : ''),"placeholder"=>"role name ... ","autocomplete"=>"off", "id"=>"formField"]) !!}
				<img src="{{asset('images/load.gif')}}" class="addLoad">
				<div class="errors">
					@error("role")
						{{$message}}
					@enderror
				</div>
				<div class="done" style="color: green; font-size: 12px;">
					
				</div>
				<span class="notes">Duplicate role names are ingnored!</span>
			</div>
			<div class="form-elemets">
				{!! Form::submit("Add",["class"=>"btn btn-sm submitButton","id"=>"submitButtonAdd"]) !!}
			</div>
		{!! form::close() !!}
	</div>

	<!-- Category update Form -->
	<div class="formDiv" id="cFormDivUpdate">
		<div class="closeFormButton" onclick="closeForm('Cupdate')"><span class="far fa-times"></span></div>
		{!! Form::open(["method"=>"PUT","action"=>"Admin\RoleController@update","id"=>"rolesUpdateForm"]) !!}
			<div class="form-elemets">
				{!! Form::label("role","Update Role",["class"=>"form-labels"]) !!}
				{!! Form::text("role",null,["class"=>"form-control ".($errors->has('role') ? ' errorForm' : ''),"placeholder"=>"role name ... ","autocomplete"=>"off", "id"=>"formFieldUpdate"]) !!}
				{!! Form::hidden("role_id",null,["id"=>"role_id"]) !!}
				<img src="{{asset('images/load.gif')}}" class="addLoad">
				<div class="errors">
					@error("role")
						{{$message}}
					@enderror
				</div>
				<div class="done" style="color: green; font-size: 12px;">
					
				</div>
				<span class="notes">Duplicate role names are ingnored!</span>
			</div>
			<div class="form-elemets">
				{!! Form::submit("Update",["class"=>"btn btn-sm submitButton","id"=>"submitButtonUpdate"]) !!}
			</div>
		{!! form::close() !!}
	</div>
	<div id="catList">
			<div class="table-responsive">
				{!! Form::open(["method"=>"DELETE","action"=>"Admin\RoleController@deleteRoles","id"=>"deleteRoleForm"]) !!}
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
						@if(count($roles) > 0)
						<h4>All Roles</h4>
						@foreach($roles as $role)
							<tr id="row-{{$role->id}}">
								<td>{{$role->id}}</td>
								<td>{{$role->role}}</td>
								<td>{{count($role->users)}}</td>
								<td>
									@if($role->createdBy)
										<a href="{{route('profile',$role->createdBy)}}" >
											{{$role->createdBy}}
										</a>
									@else
										{{$role->createdBy}}
									@endif
								</td>
								<td>
									@if($role->updatedBy)
										<a href="{{route('profile',$role->createdBy)}}" >
											{{$role->updatedBy}}
										</a>
									@else
										{{$role->updatedBy}}
									@endif
								</td>
								<td>{{$role->created_at->format("Y-M-d")}}</td>
								<td>{{$role->updated_at->format("Y-M-d")}}</td>
								<td><a href="javascript:void(0)" class="fal fa-edit" onclick="openUpdateForm({!! $role->id !!})"></a></td>
								<td style="position: relative;">
									{!! Form::checkbox("roleIds[]",$role->id,null,["class"=>"one_by_one","id"=>"checkBox-$role->id","onclick"=>"showDeleteButtonSingle()"]) !!}
								</td>
							</tr>
						@endforeach
						@else
							<h4>No Roles!</h4>
						@endif
					</tbody>
				</table>
				{!! Form::close() !!}
			</div>
			{{$roles->links()}}
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
		var rolesDelete = '{{route("roles.delete")}}';
		var storeRoles = '{{route("roles.store")}}';
		var editRoles = '{{route("roles.edit")}}';
		var updateRoles = '{{route("roles.update")}}';
	</script>
@endsection