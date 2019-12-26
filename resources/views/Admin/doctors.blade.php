@extends("../layouts.MainLayout")

@section("title","Admin Panel Doctors")

@section("content")
@include("../layouts.adminLayout")

<div id="main">
	<!-- main title -->
	<div id="usersParentDiv">
		<h4>Manage Doctors</h4>
		<div class="dropdown-divider"></div>
		<div class="title">
			<h3>

				All un-active doctors 
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
		
			<a href="{{route('doctors.index')}}" class="btn  btn-sm mb-2" id="activeDoctorButton">View Active Doctors</a>
			
			{!! Form::open(["method"=>"GET","action"=>"Admin\ManageUserController@search","id"=>"searchForm"]) !!}
				<div style="position: relative;">
					{!! Form::text("searchFor",request()->input('searchFor'),["class"=>"form-control","id"=>"searchForField","placeholder"=>"search doctors","onkeyup"=>"searchDoctors()","autocomplete"=>"off","maxLength"=>"60"]) !!}
					<a href="javascript:void(0)" id="searchIcon" class="far fa-search" onclick="submitSearchForm()"></a>
					<div id="searchTypeDiv">
						{!! Form::select('searchType',['name'=>'Name','username'=>'Username','field'=>'Field',"location"=>"Location"],request()->input('searchType'),["class"=>"form-control","id"=>"searchType"]) !!}
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
		@isset($doctors)
		<div id="usersList" class="mt-2">
			@if(count($doctors) > 0)
				<div class="row container" id="rowContainer">
					@foreach($doctors as $doctor)
						<div class="fullInfo">
							<!-- photo  -->
							<a href="{{route('profile',$doctor->account->username)}}">
								<div class="userPhoto">
									@if($doctor->account->photos()->where("status",1)->first())
										<img src="/Storage/images/doctors/{{$doctor->account->photos()->where('status',1)->first()->path}}" class="">
									@else
										<span class="noUserImage fal fa-user"></span>
									@endif
								</div>
							</a>
							<div class="userInfo">
								<span class="userName">
									<a href="{{route('profile',$doctor->account->username)}}">
										{{$doctor->fullName}}
									</a>
									<a href="javascript:void(0)" class="followBtn btn btn-sms" onclick="activateUser('{{$doctor->id}}','doctor')">
										<span id="followBtnIcon-{{$doctor->id}}" class="far"></span>
										<span id="followText-{{$doctor->id}}">
											{{ ($doctor->status == 1 ? "De-activate User" : "Activate User") }}
										</span>
									</a>
								</span>
								@if($doctor->country)
									<span class="userCountry">
										{{$doctor->country->country}}
										{{( $doctor->province ? "," . $doctor->province->province : '') }}
									</span>
								@endif
								<span class="userCountry">posts:{{$doctor->posts()->count()}}</span>
								<span class="userCountry">Followers:<span id="followersCount-{{$doctor->id}}">{{$doctor->followed()->count()}}</span></span>
							</div>
						</div>
					@endforeach
				</div>
			@else
				<h3>No Doctors Availible!</h3>
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
		var doctorsSearchResultAdmin = '{{route("admin.searchResult.doctors")}}';
		var changeStatus = '{{route("admin.changestatus.doctors")}}';
	</script>
@endsection