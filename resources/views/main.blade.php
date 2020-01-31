@extends('layouts.MainLayout')


@section('title', 'OnlineTEB')
  
@section('content')
@if(session("success"))
<script type="text/javascript">
    var status = "on";
</script>
@endif
@if(count($errors) > 0 )
    <script type="text/javascript">
        var status = "on";
    </script>
@endif
<!-- Secion1 start -->
<div id="section1" > 
    <div id="section1ContentParent">
    <div id="slogan" class="col-lg-12 col-sm-12 text-center">
        <h2>We think smarter to make life easy</h2>
    </div> 
    <div id="sloganDetail" class="col-lg-5 col-sm-8 text-center">
        <p>Online health community is a place where people "medical experts, patients and others" gathers in order to access and share health-related information</p>
    </div>
    <div id="sloganButtons" class="col-lg-4  text-center">
        <a href="javascript:void(0)" id="forUsersBtn" class="btn  userDoctorBtn">For Users</a>
        <a href="javascript:void(0)" id="forDoctorsBtn" class="btn  userDoctorBtn">For Doctors</a>   
    </div>
    </div>
</div>
<!-- Secion1 End-->

<!-- section2 start -->
<div id="section2">
    <!-- section 2 heading start -->
    <div id="section2Heading" class="col-lg-12 col-sm-12 text-center">
        <h2>For users, by OnlineTEB</h2>
    </div>
    <!-- section 2 heading end -->

    <!-- devider line -->
    <div  id="section2Devider" class="col-lg-1 col-sm-2"></div>
    <!--  devider line end -->

    <!-- section 2 description start -->
    <div id="section2Description"  class="col-lg-4 col-sm-8 text-center">
        <p>
           OnlineTEB is an online medical community. We help you get answers to yours medical problems, share information with others , reach your desired medical experts, and share your advertisement through OnlineTEB. </p>
    </div>
    <!-- section 2 description end -->

    <!-- section 2 description content start -->
    <div id="descriptionContent" class="container row">
        <!-- find and ask question div start -->
        <div  id="findQuestions" class="col-lg-3 text-center">
            <span class="fad fa-question-circle section2Icons"></span>
            <h6>Find/Ask Q&A</h6>
            <p class="container">
                Find and ask qustions ralated to medical and share your answers with others. <a href="{{route('register')}}">Sign up</a> for free account.   
            </p>
            <div class="text-center"> 
                <a href="{{route('questions.create')}}" class="btn btn-sm descriptionContentButtons">Ask Question</a>
                <a href="{{route('questions.index')}}" class="btn btn-sm descriptionContentButtons">Find Qustion</a>
            </div>
        </div>
         <!-- find and ask question div end -->

        <!-- space div start -->
        <div class="col-lg-1"></div>
        <!-- space div end -->

         <!-- Reach Doctors div start -->
        <div id="reachDoctors"  class="col-lg-3 text-center">
            <span class="fad fa-user-md-chat section2Icons"></span>
            <h6>Reach Doctors</h6>
            <p class="container">
                Find your medical experts regarding to their location, profession, and publicity. <a href="{{route('register')}}">Sign up</a> for free account.   
            </p>
            <div class="text-center"> 
                <a href="{{route('doctors.index')}}" class="btn btn-sm descriptionContentButtons">Find Doctors</a>
            </div>
        </div>
        <!-- Reach Doctors div end -->

        <!-- space div start -->
        <div class="col-lg-1"></div>
        <!-- space div end -->

        <!-- view add ads div start -->
        <div id="addAds" class="col-lg-3 text-center">
            <span class="fas fa-ad section2Icons"></span>
            <p class="container">
                Search and find the latest advertisements and share your advertisements through OnlineTEB. <a href="{{route('register')}}">Sign up</a> for free account.   
            </p>
             <div class="text-center"> 
                <a href="javascript:void(0)" id="forUsersViewAds" class="btn btn-sm descriptionContentButtons">View ads</a>
                <a href="{{route('contactus.index')}}" class="btn btn-sm descriptionContentButtons">Add your ads</a>
            </div>
        </div>
        <!-- view add ads div end -->
    </div>
     <!-- section 2 description content end -->
</div>
<!-- section2 end -->

<!-- section 3 starts -->
<div id="section3">
    <!-- section 3 heading start -->
    <div id="section3Heading" class="col-lg-12 col-sm-12 text-center">
        <h2>For doctors, by OnlineTEB</h2>
    </div>
    <!-- section 3 heading end -->

    <!-- devider line -->
    <div  id="section3Devider" class="col-lg-1 col-sm-2"></div>
    <!--  devider line end -->

    <!-- section 3 description start -->
    <div id="section3Description"  class="col-lg-4 col-sm-8 text-center">
        <p>
            Our mission is to help medical experts get publicity in short time. This means that other peoples will be able to find medical experts easily through OnlineTEB.
        </p>
    </div>
    <!-- section 3 description end -->

    <!-- section 3 description content start -->
    <div id="section3Descriptioncontent" class="row">
        
        <!--  posts div for doctors start -->
        <div id="posts" class="row">
            <div class="col-2">
                <span class="fad fa-share-alt section3Icons"></span>
            </div>
            <div class="col-10">
                <p>
                    Share your knowladege regarding health with other by adding a <a href="{{route('posts.create')}}">post</a> to your profile.
                </p>
            </div>
        </div>
        <!-- posts div for doctors end -->

        <!--  vote div for doctors start -->
        <div id="vote" class="row">
            <div class="col-2">
                <span class="fad fa-star-half-alt section3Icons"></span>
            </div>
            <div class="col-10">
                <p>
                    Help poeple diffrentiate the right and wrong information by voting  others poeples' <a href="{{route('posts.index')}}">Posts</a> & <a href="{{route('questions.index')}}">Questions</a>
                </p>
            </div>
        </div>
        <!-- vote div for doctors end -->

        <!--  ads div for doctors start -->
        <div id="ads" class="row">
            <div class="col-2">
                <span class="fad fa-bullhorn section3Icons"></span>
            </div>
            <div class="col-10">
                <p>
                    Increase your publicity by accelerating your discovery through OnlineTEB <a href="{{route('contactus.index')}}">advertising</a>.
                </p>
            </div>
        </div>
        <!-- ads div for doctors end -->
    </div>
     <!-- section 3 description content end -->
</div>
<!-- section 3 end -->

<!-- latest news part section 4 start -->
<div id="section4">
    <div class="text-center">
        <h2 id="section4Heading">Latest Advertisments</h2>
    </div>
    <div id="adsParent" class="owl-carousel container owl-theme">
        @if(count($advertisements) > 0 )
        @foreach($advertisements as $ads)
        <div class="adsItems">
                <div class="card">
                    <div class="card-heading adsImage"><img src="/Storage/images/advertisements/{{$ads->photos()->where('status',1)->first()->path}}" class="" alt="no image"></div>
                    <div class="card-body">
                        <p  class="adsTitle">{{$ads->title}}</p>
                        @if(strlen($ads->content) > 100)
                        <p>{{Str::limit($ads->content,100)}} <a href="#" class="readmore" onclick="readMore('{{$ads->id}}')">read more...</a></p>
                        @else
                        <p>{{$ads->content}}</p>
                        @endif
                        <hr>
                        <span class="categroy">{{$ads->Category->category}}</span>
                        <p class="float-right adsDate">{{$ads->created_at->diffForHumans()}}</p>
                    </div>
                </div>
        </div>
        @endforeach
        
         @else
            <h5 class="text-center">No Advertisements for now!</h5>
        @endif
    </div>
     <!-- <div class="text-center mb-2" title="All advertisements"><a href="#" class="btn btn-primary btn-sm" style="background-color:  #3fbbc0;border:1px solid #3fbbc0;">View All Advertisements</a></div> -->
        <!-- advertisements readmore div -->
    <div id="readmorediv">
        <div id="closeButtonReadmore"  class="far fa-times float-right" onclick="closeReadMore()"></div>
        <div id="readmoreHeading">
            
        </div>
        <div id="readmoredivContent">
            
        </div>
        <img src="{{asset('images/load1.gif')}}" id="readmoreLoad">
    </div>

</div>
<!-- latest news part section 4 end-->


<!-- section 5 contact form start -->
<div id="section5" class="container-fluid" > 
    <div id="section5Heading" class="text-center" sty>
        <h2>Contact Us</h2>
        <div class="dropdown-divider col-2" style="margin: 0 auto;"></div>
        <p>Have any questions? Fill out the form! We look forward to hearing from you.</p>
    </div> 

    <div id="section5Content" class="row col-lg-12">
        <div id="contactForm" class="col-lg-12">
            <div class="row">
                @if(session("success"))
                    <div class="alert alert-success col-lg-8 offset-lg-2  text-center mainPageMsgs">
                        <button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session("error"))
                    <div class="alert alert-danger col-lg-8 offset-lg-2  text-center mainPageMsgs">
                        <button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            {!! Form::open(["method"=>"POST","action"=>"ContactUsController@store"]) !!}
                <div class="row">
                    {!! Form::text("fullName",null,["class"=>"form-control contactFormElement col-lg-2 offset-lg-2 ".($errors->has("fullName") ? "ContactBackEndErrorInput" : ""),"id"=>"fullName","placeholder"=>"Your Full Name *","onkeyup"=>"enableContactButton()"]) !!}
                    <div id="fullNameErrorSmall" class="col-lg-2  contactErrorMsgs contactErrorMsgsSmallScreen">
                        @error("fullName")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-lg-1 spaceDiv"></div>
                    {!! Form::text("phoneNumber",null,["class"=>"form-control contactFormElement col-lg-2 ".($errors->has("phoneNumber") ? "ContactBackEndErrorInput" : ""),"id"=>"phoneNumber","placeholder"=>"Your Phone Number *","onkeyup"=>"enableContactButton()"]) !!}
                    <div id="phoneNumberErrorSmall" class="col-lg-2 offset-lg-2 contactErrorMsgs contactErrorMsgsSmallScreen">
                         @error("phoneNumber")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-lg-1 spaceDiv"></div>
                    {!! Form::text("emailAddress",null,["class"=>"form-control contactFormElement col-lg-2 ".($errors->has("emailAddress") ? "ContactBackEndErrorInput" : ""),"id"=>"emailAddress","placeholder"=>"Your Email *","onkeyup"=>"enableContactButton()"]) !!}
                    <div id="emailAddressErrorSmall" class="col-lg-2 offset-lg-2 contactErrorMsgs contactErrorMsgsSmallScreen">
                         @error("emailAddress")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div id="fullNameError" class="col-lg-2 offset-lg-2 contactErrorMsgs">
                         @error("fullName")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-lg-1 spaceDiv"></div>
                    <div id="phoneNumberError" class="col-lg-2  contactErrorMsgs">
                          @error("phoneNumber")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-lg-1 spaceDiv"></div>
                    <div id="emailAddressError" class="col-lg-2  contactErrorMsgs">
                        @error("emailAddress")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="row">
                    {!! Form::textarea("message",null,["class"=>"form-control contactFormElement col-lg-8 offset-lg-2".($errors->has("message") ? "ContactBackEndErrorInput" : ""),"rows"=>"7","maxlength"=>"500","id"=>"message","placeholder"=>"Your message * max 500 chars","onkeyup"=>"enableContactButton()"]) !!}
                    <div id="messageErrorForBothScreen" class="contactErrorMsgs col-lg-8 offset-lg-2">
                        @error("message")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    {!! Form::submit("Send Message",["class"=>"btn btn-sm offset-lg-2","id"=>"contactButton","onclick"=>"validateContactForm()","disabled"=>"true"]) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- section 5 end contact form -->
@endsection


@section("scripts")


<!-- These variables are for ajax  token and route to which vote the post, comments , replies-->
    <script type="text/javascript">
        var token = '{{ Session::token() }}';
        var readFull = '{{ route("ads.readMore") }}';
    </script>
@endsection
