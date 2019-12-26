@extends("../layouts.mainLayout")

@section("title","All Users")

@section("content")

	<div id="allUsersParent">
		<!-- Begginng of title and sortBy options -->
		<div class="title">
			<h3>
				@if(empty($type))
					All Users
				@endif
				@isset($type) 
					@if($type == "mostQuestions")
						Users With Most Questions
					@elseif($type == 'new')
						Mew Users
					@endif 
				@endisset 
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
		</div>
		<div class="orderBy">
			<div class="orderByOptionParent" style="">
				<a href="{{route('nusers.index')}}" class="btn btn-sm" title="All Users">
					@if(empty($type))<span class="fad fa-check"></span>@endif All
				</a>
				<a href="{{route('nusersSortBy','new')}}" class="btn btn-sm " title="The Users who are new">
					@isset($type)@if($type == "new")<span class="fad fa-check"></span>@endif @endisset 
					Newest
				</a>
				<a href="{{route('nusersSortBy','mostQuestions')}}" class="btn btn-sm " title="The userss who are new">
					@isset($type)@if($type == "mostQuestions")<span class="fad fa-check"></span>@endif @endisset 
					Most Questions
				</a>
			</div>

			<span class="float-right sortText">SortBy:</span>
		</div>
		<!-- End of title and sortBy options -->

		<!-- users list part -->
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
										<a href="javascript:void(0)" class="followBtn btn btn-sms" onclick="activateUser('{{$nuser->id}}','nuser')">
											<span id="followBtnIcon-{{$nuser->id}}" class="far"></span>
											<span id="followText-{{$nuser->id}}">
												{{ ($nuser->status == 1 ? "De-activate User" : "Activate User") }}
											</span>
										</a>
										@endif
										@endcan
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
	</script>

@endsection

