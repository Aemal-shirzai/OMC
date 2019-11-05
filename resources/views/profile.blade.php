@extends("layouts.MainLayout")
@section("title")

{{Auth::user()->owner->fullName}} ({{ Auth::user()->username }})

@endsection
@section("content")


<div id="profileParent">
	<div class="container" id="profileHeading">
		<div id="profileImageParent">
			<div id="profileImage" class="">
				@auth
					@if(count(Auth::user()->owner->photos) > 0)
						@if(Auth::user()->owner_type == 'App\NormalUser')
							<img src="/storage/images/normalUsers/{{Auth::user()->owner->photos()->where('status',1)->first()->path}}" class="" style="border">
						@else
							<img src="/storage/images/doctors/{{Auth::user()->owner->photos()->where('status',1)->first()->path}}" class="img-fluid">
						@endif
					@else
						<span class="fal fa-user" id="no-image"></span>
					@endif
				@endauth
				@guest
					<div class="alert alert-warning text-center">Need to be authenticated first!!</div>
				@endguest
			</div>
		</div>
		<div id="profileShortInfoParent">
			@auth
				<h2>{{ Auth::user()->username }}</h2>
				<span class="fal fa-cog" id="settingIconForSmallSize"></span>
				<a href="#" class="btn btn-md" id="editButton">Edit Profile</a>
				<span class="fal fa-cog" id="settingIconForLargeSize"></span>

				<div id="largeScreenBio">
					<h5>{{ Auth::user()->owner->fullName }}</h5>
					@if(Auth::user()->owner->Bio)
						<p>{{ Auth::user()->owner->Bio }}</p>
					@else
						<p>No Bio...</p>
					@endif
				</div>
			@endauth
		</div>
		<div class="clearfix"></div>
		<div id="smallScreenBio">
			<h5>{{ Auth::user()->owner->fullName }}</h5>
			@if(Auth::user()->owner->Bio)
				<p>{{ Auth::user()->owner->Bio }}</p>
			@else
				<p>No Bio...</p>
			@endif
		</div>
	</div>
</div>
 

@endsection