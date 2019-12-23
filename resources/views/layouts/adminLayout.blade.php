<div id="adminSidebar">
	<h5>Admin Panel</h5>
	<div id="adminMenus" >
		<a href="#">
			<span class="fal fa-bell"></span> 
			<span class="adminMunuText">Notifications</span> 
			<span class="badge badge-danger">4</span>
		</a>
		<a href="{{route('contact.manage')}}" class="{{ (Route::currentRouteName() === 'contact.manage' ? 'adminActive' : '' ) }}">
			<span class="fal fa-envelope"></span>
			<span class="adminMunuText">Messages</span>
		</a>
		<a href="#">
			<span class="fal fa-user-md"></span> 
			<span class="adminMunuText">Manage Doctors</span>
		</a>
		<a href="#">
			<span class="fal fa-user-cog"></span> 
			<span class="adminMunuText">Manage Normal Users</span>
		</a>
		<a href="#">
			<span class="fal fa-th"></span> 
			<span class="adminMunuText">Manage Posts</span>
		</a>
		<a href="#">
			<span class="fal fa-question"></span> 
			<span class="adminMunuText">Manage Questions</span> 
		</a>
		<a href="{{route('dcategories.manage')}}" class="{{ (Route::currentRouteName() === 'dcategories.manage' ? 'adminActive' : '' ) }}">
			<span class="fal fa-bell"></span> 
			<span class="adminMunuText">Manage Doctor Category</span> 
		</a>
		<a href="{{route('tags.manage')}}" class="{{ (Route::currentRouteName() === 'tags.manage' ? 'adminActive' : '' ) }}">
			<span class="fal fa-tags"></span> 
			<span class="adminMunuText">Manage Tags</span>
		</a>
		<a href="#">
			<span class="fal fa-ad"></span> 
			<span class="adminMunuText">Manage Advertisementss</span>
		</a>
		<a href="{{route('roles.manage')}}" class="{{ (Route::currentRouteName() === 'roles.manage' ? 'adminActive' : '' ) }}">
			<span class="fal fa-bell"></span>
			<span class="adminMunuText">Roles</span>
		</a>
	</div>
</div>
