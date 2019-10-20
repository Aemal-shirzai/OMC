@extends('layouts.app1')


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
        <a href="#" class="btn  userDoctorBtn">For Users</a>
        <a href="#" class="btn  userDoctorBtn">For Doctors</a>   
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
            <span class="fad fa-question section2Icons"></span>
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
                <a href="#" class="btn btn-sm descriptionContentButtons">View ads</a>
                <a href="#" class="btn btn-sm descriptionContentButtons">Add your ads</a>
            </div>
        </div>
        <!-- view add ads div end -->
    </div>
     <!-- section 2 description content end -->
</div>
<!-- section2 end -->
@endsection

