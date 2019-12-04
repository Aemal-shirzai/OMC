@extends("../layouts.MainLayout")

@section("title","Edit your reply")

@section("content")

<div class="" id="addPostParent">
	<h3 id="mainTitle">Edit your reply</h3>
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
			<div class="alert alert-warning messages mb-3">
				<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
				{{ session("error") }} or if it still shows up then let us help you by <a href="#">contacting us</a>
			</div>
		@endif
		@if(session("erro1r"))
			<div class="alert alert-warning messages mb-3">
				<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
				{{ session("error1") }} , photo and content can not be null in same time
			</div>
		@endif
		@include('../layouts.messages')
		{!! Form::model($reply,["method"=>"PUT","action"=>["CommentReplyController@update",$reply->id],"files"=>"true","id"=>"postAddingForm"]) !!}
			<div class="form-elements">
				{!! Form::label("replyContent","Content",["class"=>"labels"]) !!}
				<small class="smallNotes">Add the description of the title and any optional extra preference links</small>
				{!! Form::textarea("replyContent",$reply->content,["class"=>"form-control postFormInputs". ($errors->has('replyContent') ? ' formErrorForFields' : ''),"id"=>"crField","placeholder"=>"Add reply","maxLength"=>"65500","onkeyup"=>"validate_enable_button(this)"]) !!}
				<span class="ErrorMessage" id="errorForContent">
					@error('replyContent')
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
				<div class="container text-center" id="PhotoParentDiv" @if($reply->photos()->where('status',1)->first()) style="display: block;" @endif>
					<span id="changePhoto" onclick="opencrPhotoField()"><i class="far fa-edit" ></i> <span class="photoText">Change photo</span></span>
					<span id="removePhoto" onclick="removecrPhoto()"><i class="far fa-times" ></i> <span class="photoText">Remove photo</span></span>
					<div id="photoDiv">
						<img src="
							@if($reply->photos()->where('status',1)->first())/Storage/images/comment_replies/{{$reply->photos()->where('status',1)->first()->path}}@endif" 
							id="img-placeholder" class="img-fluid">
					</div>
				</div>
				{!! Form::file("replyPhoto",["class"=>"form-control","id"=>"crPhotoField","disabled"=>"true","style"=>"display:none;","onchange"=>"showAndcrValidateFile()"]) !!}
				<a href="javascrip:void(0)" class="fal fa-image" id="imageIcon" onclick="opencrPhotoField()"></a>
				<span class="ErrorMessage ml-1">
					@error('replyPhoto')
						{{ $message }}
					@enderror
				</span>
				@if($reply->photos()->where("status",1)->first())
					{!! Form::hidden("fileRemoved","true",["disabled"=>"true","id"=>"fileRemovedStatus"]) !!}
				@endif
			</div>

			<div class="dropdown-divider" id="dividerAfterPhoto"></div>				
			<div class="clearfix"></div>

			<div class="form-elements">
				{!! Form::submit("Edit Reply",["class"=>"btn btn-sm","id"=>"submitButton","onclick"=>"validateCommentReplyForm()"]) !!}

				@if($reply->to_type == "App\Post")
					<a href="{{route('posts.show',$commentOwner->id)}}" class="btn btn-sm" id="submitButton">Cancel<a>
				@else
					<a href="{{route('questions.show',$commentOwner->id)}}" class="btn btn-sm" id="submitButton">Cancel<a>
				@endif
			</div>

		{!! Form::close() !!}
	</div>
	<!-- End of Second par form -->

	<div class="clearfix"></div>
</div>

@endsection
