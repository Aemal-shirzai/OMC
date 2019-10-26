@extends('layouts.MainLayout')


@section('title', 'omc')
  
@section('content')

<!-- Secion1 start -->
<div id="section1" > 
    <div id="slogan" class="col-lg-12 col-sm-12 text-center">
        <h2>We think harder to make life easy</h2>
    </div> 
    <div id="sloganDetail" class="col-lg-5 col-sm-8 text-center">
        <p>We think harder to make life easy We think harder to make life easy We think harder to make life easy We think harder to make life easy We think harder to make life easy</p>
    </div>
    <div id="sloganButtons" class="col-lg-4  text-center">
        <a href="javascript:void(0)" id="forUsersBtn" class="btn  userDoctorBtn">For Users</a>
        <a href="javascript:void(0)" id="forDoctorsBtn" class="btn  userDoctorBtn">For Doctors</a>   
    </div>
</div>
<!-- Secion1 End-->

<!-- section2 start -->
<div id="section2">
    <!-- section 2 heading start -->
    <div id="section2Heading" class="col-lg-12 col-sm-12 text-center">
        <h2>For users, by online medical community</h2>
    </div>
    <!-- section 2 heading end -->

    <!-- devider line -->
    <div  id="section2Devider" class="col-lg-1 col-sm-2"></div>
    <!--  devider line end -->

    <!-- section 2 description start -->
    <div id="section2Description"  class="col-lg-4 col-sm-8 text-center">
        <p>
           OMC is an online medical community. We help you get answers to yours medical problems, share information with others , reach your desired medical experts, and share your advertisement through omc. </p>
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
                <a href="#" class="btn btn-sm descriptionContentButtons">Ask Question</a>
                <a href="#" class="btn btn-sm descriptionContentButtons">Find Qustion</a>
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
                <a href="#" class="btn btn-sm descriptionContentButtons">Find Doctors</a>
            </div>
        </div>
        <!-- Reach Doctors div end -->

        <!-- space div start -->
        <div class="col-lg-1"></div>
        <!-- space div end -->

        <!-- view add ads div start -->
        <div id="addAds" class="col-lg-3 text-center">
            <span class="fas fa-ad section2Icons"></span>
            <h6>View and Add Advertisements</h6>
            <p class="container">
                Search and find the latest advertisements and share your advertisements through omc. <a href="{{route('register')}}">Sign up</a> for free account.   
            </p>
             <div class="text-center"> 
                <a href="javascript:void(0)" id="forUsersViewAds" class="btn btn-sm descriptionContentButtons">View ads</a>
                <a href="#" class="btn btn-sm descriptionContentButtons">Add your ads</a>
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
        <h2>For doctors, by online medical community</h2>
    </div>
    <!-- section 3 heading end -->

    <!-- devider line -->
    <div  id="section3Devider" class="col-lg-1 col-sm-2"></div>
    <!--  devider line end -->

    <!-- section 3 description start -->
    <div id="section3Description"  class="col-lg-4 col-sm-8 text-center">
        <p>
            Our mission is to help medical experts get publicity in short time. This means that other peoples will be able to find medical experts easily through omc.
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
                    Share your knowladege regarding health with other by adding a <a href="#">post</a> to your profile.
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
                    Help poeple diffrentiate the right and wrong information by <a href="#">voting</a> others poeple work.
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
                    Increase your publicity by accelerating your discovery through omc <a href="#">advertising</a>.
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
        <div class="adsItems">
            <div class="card">
                <div class="card-heading adsImage"><img src="{{asset('images/section1.jpg')}}" class="img-fluid" style="height:100px;" alt="no image"></div>
                <div class="card-body">
                    <p  class="adsTitle">Murtaza</p>
                    <p class="adsContent"> Our mission is to help medical experts get publicity in short time. This means that other peoples will be able to find medical experts easily through omc.</p>
                    <hr>
                    <a href="#" class="stretched-link">Read More...</a>
                    <p class="float-right adsDate">{{\Carbon\Carbon::now()->format("Y-M-d")}}</p>
                </div>
            </div>
        </div>
        <div class="adsItems">
            <div class="card">
                <div class="card-heading adsImage"><img src="{{asset('images/section1.jpg')}}" class="img-fluid" style="height:100px;" alt="no image"></div>
                <div class="card-body">
                    <p  class="adsTitle">Murtaza</p>
                    <p class="adsContent"> Our mission is to help medical experts get publicity in short time. This means that other peoples will be able to find medical experts easily through omc.</p>
                    <hr>
                    <a href="#" class="stretched-link">Read More...</a>
                    <p class="float-right adsDate">{{\Carbon\Carbon::now()->format("Y-M-d")}}</p>
                </div>
            </div>
        </div>
        <div class="adsItems">
            <div class="card">
                <div class="card-heading adsImage"><img src="{{asset('images/section1.jpg')}}" class="img-fluid" style="height:100px;" alt="no image"></div>
                <div class="card-body">
                    <p  class="adsTitle">Murtaza</p>
                    <p class="adsContent"> Our mission is to help medical experts get publicity in short time. This means that other peoples will be able to find medical experts easily through omc.</p>
                    <hr>
                    <a href="#" class="stretched-link">Read More...</a>
                    <p class="float-right adsDate">{{\Carbon\Carbon::now()->format("Y-M-d")}}</p>
                </div>
            </div>
        </div>
        <div class="adsItems">
            <div class="card">
                <div class="card-heading adsImage"><img src="{{asset('images/section1.jpg')}}" class="img-fluid" style="height:100px;" alt="no image"></div>
                <div class="card-body">
                    <p  class="adsTitle">Murtaza</p>
                    <p class="adsContent"> Our mission is to help medical experts get publicity in short time. This means that other peoples will be able to find medical experts easily through omc.</p>
                    <hr>
                    <a href="#" class="stretched-link adsReadMore">Read More...</a>
                    <p class="float-right adsDate">{{\Carbon\Carbon::now()->format("Y-M-d")}}</p>
                </div>
            </div>
        </div>
        <div class="adsItems">
            <div class="card">
                <div class="card-heading adsImage"><img src="{{asset('images/section1.jpg')}}" class="img-fluid" style="height:100px;" alt="no image"></div>
                <div class="card-body">
                    <p  class="adsTitle">Murtaza</p>
                    <p class="adsContent"> Our mission is to help medical experts get publicity in short time. This means that other peoples will be able to find medical experts easily through omc.</p>
                    <hr>
                    <a href="#" class="stretched-link">Read More...</a>
                    <p class="float-right adsDate">{{\Carbon\Carbon::now()->format("Y-M-d")}}</p>
                </div>
            </div>
        </div>
        <div class="adsItems">
            <div class="card">
                <div class="card-heading adsImage"><img src="{{asset('images/section1.jpg')}}" class="img-fluid" style="height:100px;" alt="no image"></div>
                <div class="card-body">
                    <p  class="adsTitle">Murtaza</p>
                    <p class="adsContent"> Our mission is to help medical experts get publicity in short time. This means that other peoples will be able to find medical experts easily through omc.</p>
                    <hr>
                    <a href="#" class="stretched-link">Read More...</a>
                    <p class="float-right adsDate">{{\Carbon\Carbon::now()->format("Y-M-d")}}</p>
                </div>
            </div>
        </div>
</div>
<!-- latest news part section 4 end-->


<!-- section 5 contact form start -->
<div id="section5" class="container-fluid" > 
    <div id="section5Heading" class="text-center" sty>
        <h2>Have some questions?</h2>
    </div> 

    <div id="section5Content" class="row col-lg-12">
        <div id="contactIcon" class="col-lg-5">
            <p>Have any questions? Fill out the form! We look forward to hearing from you.</p>
            <div class="text-center">
                <span>
                    <img src="{{ asset('images/email (16).png') }}">
                </span>
            </div>
        </div>
        <div id="contactForm" class="col-lg-7">
            {!! Form::open() !!}
                <div class="row">
                    {!! Form::text("fullName",null,["class"=>"form-control contactFormElement col-lg-3 col-sm-3","id"=>"fullName","placeholder"=>"Your Full Name *","onkeyup"=>"enableContactButton()"]) !!}
                    <div id="fullNameErrorSmall" class="col-lg-3 col-sm-3 contactErrorMsgs contactErrorMsgsSmallScreen"></div>
                    <div class="col-lg-1 col-sm-1"></div>
                    {!! Form::text("phoneNumber",null,["class"=>"form-control contactFormElement col-lg-3 col-sm-3","id"=>"phoneNumber","placeholder"=>"Your Phone Number *","onkeyup"=>"enableContactButton()"]) !!}
                    <div id="phoneNumberErrorSmall" class="col-lg-3 col-sm-3 contactErrorMsgs contactErrorMsgsSmallScreen"></div>
                    <div class="col-lg-1 col-sm-1"></div>
                    {!! Form::text("emailAddress",null,["class"=>"form-control contactFormElement col-lg-3 col-sm-3","id"=>"emailAddress","placeholder"=>"Your Email *","onkeyup"=>"enableContactButton()"]) !!}
                    <div id="emailAddressErrorSmall" class="col-lg-3 col-sm-3 contactErrorMsgs contactErrorMsgsSmallScreen"></div>
                </div>
                <div class="row">
                    <div id="fullNameError" class="col-lg-3 col-sm-3 contactErrorMsgs"></div>
                    <div class="col-lg-1 col-sm-1"></div>
                    <div id="phoneNumberError" class="col-lg-3 col-sm-3 contactErrorMsgs"></div>
                    <div class="col-lg-1 col-sm-1"></div>
                    <div id="emailAddressError" class="col-lg-3 col-sm-3 contactErrorMsgs"></div>
                </div>
                <div class="row">
                    {!! Form::textarea("message",null,["class"=>"form-control contactFormElement col-lg-11 col-sm-11","cols"=>"3","rows"=>"4","id"=>"message","placeholder"=>"Your message *","onkeyup"=>"enableContactButton()"]) !!}
                    <div id="messageErrorForBothScreen" class="contactErrorMsgs"></div>
                </div>
                <div class="row mt-2">
                    {!! Form::submit("Send Message",["class"=>"btn btn-sm","id"=>"contactButton","onclick"=>"validateContactForm()","disabled"=>"true"]) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- section 5 end contact form -->
@endsection

