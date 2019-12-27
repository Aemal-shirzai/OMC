@extends("../layouts.mainLayout")

@section("title","All Users")

@section("content")

	<div id="allUsersParent">
		<!-- Begginng of title and sortBy options -->
		<div class="title">
			<h3>
				All users
				@if(request()->searchType === 'name')
					for ({{request()->searchFor}})
				@endif
			</h3>
		</div>
		<div id="searchFor">
			@can("normaluser_related",Auth::user())
				@can("admin_related",Auth::user())
					<a href="{{route('nusers.manage.index')}}" class="btn  btn-sm mb-2" id="activeDoctorButton">View De-active users</a>
				@endcan
			@endcan
			{!! Form::open(["method"=>"GET","action"=>"NormalUserController@search","id"=>"searchForm"]) !!}
				<div style="position: relative;">
					{!! Form::text("searchFor",request()->input('searchFor'),["class"=>"form-control","id"=>"searchForField","placeholder"=>"search users","onkeyup"=>"searchNusers()","autocomplete"=>"off","maxLength"=>"60"]) !!}
					<a href="javascript:void(0)" id="searchIcon" class="far fa-search" onclick="submitSearchForm()"></a>
					<div id="searchTypeDiv">
						{!! Form::select('searchType',['name'=>'name','username'=>'username'],request()->input('searchType'),["class"=>"form-control","id"=>"searchType"]) !!}
					</div>
				</div>
			{!! Form::close() !!}
			<div id="searchResult">
				<h6 id="searchInfo"><span id="searchText">results</span> <img src="{{asset('images/load1.gif')}}" id="searchLoad"></h6>
				<div id="allResultsDiv">
					
				</div>
			</div>
			@isset($notFound)
				<div class="alert alert-danger alert-sm" style="font-weight: bold;font-size: 12px;text-align: center;">
					 {{$notFound}}
				</div>
			@endisset
		</div>
		<div class="orderBy">
			<div class="orderByOptionParent" style=""></div>
			<span class="float-right sortText"></span>
		</div>
		<!-- End of title and sortBy options -->

		<!-- users list part -->
		@isset($nusers)
		<div id="usersList" class="mt-2">
			@if(count($nusers) > 0)
				<div class="row container" id="rowContainer">
					@foreach($nusers as $nuser)
						<div class="fullInfo">
							<!-- photo  -->
							<a href="{{route('profile',$nuser->account->username)}}">
								<div class="userPhoto">
									@if($nuser->account->photos()->where("status",1)->first())
										<img src="/Storage/images/normalUsers/{{$nuser->account->photos()->where('status',1)->first()->path}}" class="">
									@else
										<span class="noUserImage fal fa-user"></span>
									@endif
								</div>
							</a>
							<div class="userInfo">
								<span class="userName">
									<a href="{{route('profile',$nuser->account->username)}}">
										{{$nuser->fullName}}
									</a>
									@can("doctor_related",Auth::user())
									@if(Auth::user()->owner->followed()->where('normal_users.id',$nuser->id)->first())
										<span class="userCountry">Your Fan</span>
									@endif
									@endcan
									@can("normaluser_related",Auth::user())
										@can("admin_related",Auth::user())
										@if(Auth::user()->isNot($nuser->account))
										@if($nuser->role->role != "admin")
										<a href="javascript:void(0)" class="followBtn btn btn-sms" id="changeStatusButton-{{$nuser->id}}" onclick="activateUser('{{$nuser->id}}','nuser')">
											<span id="followBtnIcon-{{$nuser->id}}" class="far"></span>
											<span id="followText-{{$nuser->id}}">
												{{ ($nuser->status == 1 ? "De-activate User" : "Activate User") }}
											</span>
										</a>
										@endif
										@endif
										@endcan
									@endcan
									<span class="far fa-check" style="color: #3fbbc0;display: none;" id="adminText-{{$nuser->id}}">Admin</span>
									@can("admin_related",Auth::user())
										@if(Auth::user()->isNot($nuser->account))
										@if($nuser->role->role != 'admin' )
											<a href="javascript:void(0)" class="followBtn btn btn-sms mt-1" id="changeRoleButton-{{$nuser->id}}" onclick="changeRole('{{$nuser->id}}')">
												<span id="RoleBtnIcon-{{$nuser->id}}" class="far"></span>
												<span id="RoleText-{{$nuser->id}}">
													Promote To Admin
												</span>
											</a>
										@else
											<span class="far fa-check" style="color: #3fbbc0;display: block;" id="adminText-{{$nuser->id}}">Admin</span>
										@endif
										@endif
									@endcan
								</span>
								@if($nuser->country)
									<span class="userCountry">
										{{$nuser->country->country}}
										{{( $nuser->province ? "," . $nuser->province->province : '') }}
									</span>
								@endif
								<span class="userCountry">Questions:{{$nuser->questions()->count()}}</span>
								<span class="userCountry">Follows:<span id="followersCount-{{$nuser->id}}">{{$nuser->following()->count()}}</span></span>
							</div>
						</div>
					@endforeach
				</div>
			@else
				<h3>No Users Availible!</h3>
			@endif			
		</div>

	{{$nusers->links()}}
	@endisset
	</div>
@endsection


@section("scripts")
<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';
		// This route is to add and remove doctors to follow by normal user
		var DoctorFollow = '{{route("DoctorFollow")}}';
		var nusersSearchResult = '{{route("searchResult.nusers")}}';
		var changeStatusUser = '{{route("admin.changestatus.nusers")}}';
		var roleChange = '{{route("admin.changeRole.nusers")}}';
	</script>

@endsection

