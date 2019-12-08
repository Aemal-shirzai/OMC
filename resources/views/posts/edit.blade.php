@extends("../layouts.MainLayout")

@section("title","Edit your post")

@section("content")

<div class="" id="addPostParent">
	<h3 id="mainTitle">Edit your post</h3>
	<!-- Beggingon of : PART ONE  TIPS -->
	<div id="tips" class="card">
		<div class="card-header" id="headerForLarge"><span id="noteHeading">Make Your Post More Efficient</span></div>
		<div class="card-header" id="headerForSmall"  onclick="showTipsContent();"><span id="noteHeading">Make Your Post More Efficient <i class="far fa-chevron-down float-right" id="tipsIconForSmall"></i></span></div>
		
		<div class="card-body" id="tipsContent">
			<span id="note">Share your knowladege regarding health with others to help them with their health problems.</span>
			<span id="caution">Avoid posting irrelevent topics</span>
			<div id="points">
				<ol>
					<li>
						<span onclick="openTIpsContent('duplicate','1')" class="tipsButton">Make sure it is not postd before <i class="far fa-chevron-down float-right icon" id="icon-1"></i></span>
						<ul class="tipsContent" id="duplicate">
							<li>Always search the title before posting, to make sure it is not duplicate</li>
							<li>Posting duplicate topics are not favorites to be viewd</li>
							<li>Make sure to add extra references and inforamtion if the topics are duplicate</li>
						</ul>
					</li>
					<div class="dropdown-divider"></div>
					<li>
						<span onclick="openTIpsContent('summarized','2')" class="tipsButton">Summarize your post <i class="far fa-chevron-down float-right icon" id="icon-2"></i></span>
						<ul class="tipsContent" id="summarized">
							<li>Make your topic shorter, if it is posible to be described in short terms</li>
							<li>It is more frequent for users to read summarized topics rather than long topics </li>
						</ul>
					</li>
					<div class="dropdown-divider"></div>
					<li>
						<span onclick="openTIpsContent('addTags','3')" class="tipsButton"> Add tags to your post <i class="far fa-chevron-down float-right icon" id="icon-3"></i> </span>
						<ul class="tipsContent" id="addTags">
							<li>Add tags to post, and it will describe your post content</li>
							<li>Help people find your post by tags you attached to your post</li>
						</ul>
					</li>
				</ol>
			</div><!-- End of points div -->
		</div> <!-- End of card body -->
	</div>	<!-- End of card -->
	<!-- End of : PART ONE  TIPS -->

	<!-- Second part Form -->
	<div id="formParent">
		@if(session("error"))
			<div class="alert alert-warning messages">
				<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
				{{ session("error") }} or if it still shows up then let us help you by <a href="#">contacting us</a>
			</div>
		@endif
		@include('../layouts.messages')
		{!! Form::model($post,["method"=>"PUT","action"=>["PostController@update",$post->id],"files"=>"true","id"=>"postAddingForm"]) !!}
			<div class="form-elements">
				{!! Form::label("title","Title",["class"=>"labels"]) !!}
				<small class="smallNotes">Be specific in choosing the title for your post</small>
				{!! Form::text("title",null,["class"=>"form-control postFormInputs". ($errors->has('title') ? ' formErrorForFields' : ''),"placeholder"=>"e.g. The side effects of alchahol on hearth","id"=>"title","onkeyup"=>"validateTitleAndEnableButton()"]) !!}
				<span class="ErrorMessage" id="errorForTitle">
					@error('title')
						{{ $message }}
					@enderror
				</span>
			</div>
			<div class="form-elements">
				{!! Form::label("content","Content",["class"=>"labels"]) !!}
				<small class="smallNotes">Add the description of the title and any optional extra preference links</small>
				{!! Form::textarea("content",null,["class"=>"form-control postFormInputs". ($errors->has('content') ? ' formErrorForFields' : ''),"id"=>"content","placeholder"=>"The shorter the better","maxLength"=>"65500","onkeyup"=>"validateContentAndEnableButton()"]) !!}
				<span class="ErrorMessage" id="errorForContent">
					@error('content')
						{{ $message }}
					@enderror
				</span>
			</div>
			<div class="form-elements">
				<div id="invalidFile" class="container text-center alert alert-danger alert-sm">
				<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
				<span id="invalidFileMessage">
					
				</span>
			</div>
			<div class="container text-center" id="PhotoParentDiv" @if($post->photos()->where('status',1)->first()) style="display: block;" @endif>
				<span id="changePhoto" onclick="openPostPhotoField()"><i class="far fa-edit" ></i> <span class="photoText">Change photo</span></span>
				<span id="removePhoto" onclick="removePhoto()"><i class="far fa-times" ></i> <span class="photoText">Remove photo</span></span>
				<div id="photoDiv">
					<img src="
						@if($post->photos()->where('status',1)->first())/Storage/images/posts/{{$post->photos()->where('status',1)->first()->path}}@endif" 
						id="img-placeholder" class="img-fluid">
				</div>
			</div>
				{!! Form::file("photo",["class"=>"form-control","accept"=>"image/*","id"=>"PhotoField","disabled"=>"true","style"=>"display:none;"]) !!}
				<a href="javascrip:void(0)" class="fal fa-image" id="imageIcon" onclick="openPostPhotoField()"></a>
				<span class="ErrorMessage ml-1">
					@error('photo')
						{{ $message }}
					@enderror
				</span>
				@if($post->photos()->where("status",1)->first())
					{!! Form::hidden("fileRemoved","true",["disabled"=>"true","id"=>"fileRemovedStatus"]) !!}
				@endif
			</div>
			<div class="dropdown-divider" id="dividerAfterPhoto"></div>
			<div class="form-elements">

				{!! Form::label("tags","Tags",["class"=>"labels"]) !!}
				<small class="smallNotes">Add up to 5 tags to your post which will describe what your post is about</small>

				<span class="far fa-question float-right mr-1" id="tagInfoIcon" onclick="showTagInfo()"></span>
				<div id="tagInfo">
					<h6>How to add tags</h6>
					<span>Tags help poeple find your post, and describe your post</span>
					<ul>
						<li>Click the (click here to select tags) button bellow the content part</li>
						<li>You will be opend a list of tags you can select maximum 5 tags for your post</li>
						<li>Choose the tags which are the most relevent to your post</li>
					</ul>
					<h6>If your desired tag is not in list:</h6>
					<span>Then just add your post without tags and <a href="#">ask US to add one for you</a></span>
				</div>

				<a href="javascrip:void(0)" onclick="showTags()" id="addTagLink" class="btn  btn-sm {{($errors->has('tags') ? 'errorButton' : '')}}">
					<span id="tagsCount" class="badge badge-pill badge-light">{{$post->tags()->count()}}</span> &nbsp;
					click here to select tags
				</a>
				
				<div class="clearfix"></div>
				<span class="ErrorMessage float-right mr-1 mb-2" id="tagsErrorMessage">
					@error('tags')
						{{ $message }}
					@enderror
				</span>
				<div id="tags">
					<table class="table">
						<thead>
							<tr>
								<th>Tag Name</th>
								<th>Select</th>
							</tr>
						</thead>
						<tbody>
							<span id="tagsNote">Choose with maximum of 5 tags</span>
							<a href="javascript:void(0)" onclick="showTags()" class="btn btn-sm" id="tagsDoneBtn">Done</a>
							@if(count($d_categories) > 0)
							@foreach($d_categories as $d_category)
							<tr>
								<td><label> {{$d_category->category}} </label></td>
								<td>{!! Form::checkbox("tags[]",$d_category->id,null,["class"=>"tagsCheckboxes ml-4","id"=>"tag-$d_category->id","onchange"=>"showAndValidateTagsCountEdit('$d_category->id')"]) !!}</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
				<!-- old Tags part  -->
				<div class="tags">
					@if($post->tags()->count() > 0)
						@foreach($post->tags as $tag)
							<div style="overflow: hidden;" onclick="removeTags('{{$tag->id}}')" id="oldTag-{{$tag->id}}">
								<button class="close">
									&times;
								</button>
								<a href="javascript:void()">
									{{$tag->category}}
								</a>
							</div>
						@endforeach
					@endif
				</div>
				<!-- old tags part end -->
			</div>
			<div class="clearfix"></div>
			<div class="form-elements">
				<div class="dropdown-divider"></div>
				{!! Form::submit("Edit Post",["class"=>"btn btn-sm","id"=>"submitButton","onclick"=>"validatePostForm()"]) !!}
				<a href="{{route('posts.show',$post->id)}}" class="btn btn-sm" id="submitButton">Cancel<a>
			</div>
		{!! Form::close() !!}
	</div>
	<!-- End of Second par form -->

	<div class="clearfix"></div>
</div>

@endsection