@extends("../layouts.mainLayout")

@section("title","All Doctors")

@section("content")


	<div id="allUsersParent">
		<div class="title">
			<h3>
				All results for {{request()->searchFor}}
			</h3>
		</div>
		<div id="searchFor">
			{!! Form::open(["method"=>"GET","action"=>"DoctorController@search","id"=>"searchForm"]) !!}
				<div style="position: relative;">
					{!! Form::text("searchFor",request()->input('searchFor'),["class"=>"form-control","id"=>"searchForField","placeholder"=>"search doctors","onkeyup"=>"searchDoctors()","autocomplete"=>"off","maxLength"=>"60"]) !!}
					<a href="javascript:void(0)" id="searchIcon" class="far fa-search" onclick="submitSearchForm()"></a>
					<div id="searchTypeDiv">
						{!! Form::select('searchType',['name'=>'name','username'=>'username','field'=>'field'],request()->input('searchType'),["class"=>"form-control","id"=>"searchType"]) !!}
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
				<span class="float-right sortText"></span>
			</div>
		</div>
		<!-- End of title and sortBy options -->

		<!-- users list part -->
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
									@can("normalUser_related",Auth::user())
										<a href="javascript:void(0)" class="followBtn btn btn-sms" onclick="followDoctor('{{$doctor->id}}')">
											<span id="followBtnIcon-{{$doctor->id}}" class="far {{ (Auth::user()->owner->following()->where('doctors.id',$doctor->id)->first() ? 'fa-check' : 'fa-plus') }}" id="followeIcon-{{$doctor->id}}"></span>
											<span id="followText-{{$doctor->id}}">
												{{ (Auth::user()->owner->following()->where('doctors.id',$doctor->id)->first() ? "Following" : "Follow")}}
											</span>
										</a>
									@endcan
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

	{{$doctors->links()}}
	</div>
@endsection


@section("scripts")
<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';
		// This route is to add and remove doctors to follow by normal user
		var DoctorFollow = '{{route("DoctorFollow")}}';

		var doctorsSearchResult = '{{route("searchResult.doctors")}}';
	</script>

@endsection