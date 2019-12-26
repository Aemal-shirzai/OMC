@extends("../layouts.mainLayout")

@section("title","All Users")

@section("content")
@include("../layouts.adminLayout")
<div id="main">
	<div id="usersParentDiv">
		<h4>Manage Normal users</h4>
		<div class="dropdown-divider"></div>
		<!-- Begginng of title and sortBy options -->
		<div class="title">
			<h3>
				All un-active users 
				@if(request()->searchType === 'name')
					for ({{request()->searchFor}})
				@elseif(request()->searchType === "field")
					with field ({{request()->searchFor}})
				@elseif(request()->searchType === "location")
					in location ({{request()->searchFor}})
				@endif
			</h3>
		</div>
		<div id="searchFor">
			<a href="{{route('nusers.index')}}" class="btn  btn-sm mb-2" id="activeDoctorButton">View Active users</a>
			{!! Form::open(["method"=>"GET","action"=>"Admin\ManageUserController@nuserSearch","id"=>"searchForm"]) !!}
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
			<div class="alert alert-danger alert-sm" style="font-size: 12px;font-weight: bold;text-align: center;">
				{{$notFound}}
			</div>
		@endisset
		</div>
		<!-- End of title and sortBy options -->
		<div class="dropdown-divider"></div>
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
									<a href="javascript:void(0)" class="followBtn btn btn-sms" onclick="activateUser('{{$nuser->id}}','nuser')">
										<span id="followBtnIcon-{{$nuser->id}}" class="far"></span>
										<span id="followText-{{$nuser->id}}">
											{{ ($nuser->status == 1 ? "De-activate User" : "Activate User") }}
										</span>
									</a>
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
		@endisset
	</div>
</div>
@endsection


@section("scripts")
<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';

		var nusersSearchResultAdmin = '{{route("admin.searchResult.nusers")}}';
		var changeStatusUser = '{{route("admin.changestatus.nusers")}}';
	</script>

@endsection

