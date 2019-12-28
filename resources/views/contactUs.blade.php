@extends('layouts.MainLayout')


@section('title', 'OnlineTEB contact us')
  
@section('content')
<div class="col-lg-6" style="padding: 12px 12px;margin: 0 auto;">
  <div class="form-wrapper">
    <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
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
      <div class="panel panel-skin">
        <div class="panel-heading">
          <h3 class="panel-title text-center" ><span class="far fa-pencil-square-o"></span> Contact Us</h3>
        </div>
        <div class="panel-body">
           {!! Form::open(["method"=>"POST","action"=>"ContactUsController@store"]) !!}
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <label>Full Name *</label>
                  {!! Form::text("fullName",null,["class"=>"form-control contactFormElement ".($errors->has("fullName") ? "ContactBackEndErrorInput" : ""),"id"=>"fullName","onkeyup"=>"enableContactButton1()"]) !!}
                    <div id="fullNameError" class="contactErrorMsgs ">
                        @error("fullName")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Phone number *</label>
                  {!! Form::text("phoneNumber",null,["class"=>"form-control contactFormElement ".($errors->has("phoneNumber") ? "ContactBackEndErrorInput" : ""),"id"=>"phoneNumber","onkeyup"=>"enableContactButton1()"]) !!}
                    <div id="phoneNumberErrorSmall" class="col-lg-6 contactErrorMsgs contactErrorMsgsSmallScreen">
                         @error("phoneNumber")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Email *</label>
                  {!! Form::text("emailAddress",null,["class"=>"form-control contactFormElement ".($errors->has("emailAddress") ? "ContactBackEndErrorInput" : ""),"id"=>"emailAddress","onkeyup"=>"enableContactButton1()"]) !!}
                    <div id="emailAddressErrorSmall" class="col-lg-6 contactErrorMsgs contactErrorMsgsSmallScreen">
                         @error("emailAddress")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
                    <!-- <div class="col-lg-1 spaceDiv"></div> -->
                    <div id="phoneNumberError" class="col-lg-6   contactErrorMsgs">
                          @error("phoneNumber")
                            {{ $message }}
                        @enderror
                    </div>
                    <!-- <div class="col-lg-1 spaceDiv"></div> -->
                    <div id="emailAddressError" class="col-lg-6   contactErrorMsgs">
                        @error("emailAddress")
                            {{ $message }}
                        @enderror
                    </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <label>Message *</label>
                  {!! Form::textarea("message",null,["class"=>"form-control contactFormElement ".($errors->has("message") ? "ContactBackEndErrorInput" : ""),"rows"=>"5","maxlength"=>"500","id"=>"message","onkeyup"=>"enableContactButton1()"]) !!}
                    <div id="messageErrorForBothScreen" class="contactErrorMsgs">
                        @error("message")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
              </div>
            </div>
            <!-- <input type="submit" value="Submit" class="btn btn-primary btn-lg"> -->
             {!! Form::submit("Send Message",["class"=>"btn btn-sm col-12 ","id"=>"contactButton","onclick"=>"validateContactForm()","disabled"=>"true"]) !!}

          {!! Form::close() !!}
        </div>
      </div>

    </div>
  </div>
</div>

@endsection