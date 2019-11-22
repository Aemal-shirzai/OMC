@extends("../layouts.MainLayout")

@section("title","Add your post")

@section("content")

<div class="container" id="addPostParent">
	<h3 id="mainTitle">Add your post</h3>
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

	<div class="clearfix"></div>
</div>

@endsection