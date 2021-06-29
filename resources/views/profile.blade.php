@extends('layouts.app')
@section('css')
@parent
<!-- <link rel="stylesheet" href="{{ asset('assets') }}/vendors/x-editable/bootstrap-editable.css"> -->
@endsection

@section('content')
    <div class="content-wrapper pb-0">
    	<div class="row">
    		<div class="col-lg-6 grid-margin stretch-card">
               <div class="card">
                  <div class="card-body">
               
                  	<div class="d-flex justify-content-between">
                          <div class="user-avatar mb-auto">
                            <img src="{{ Auth::user()->image == null ? '/images/users/user-circle.png' : Auth::user()->image }}" alt="{{ Auth::user()->name }}" class="profile-img img-lg rounded-circle">
                          </div>
                          <div class="wrapper d-flex align-items-center">
                            <h3>{{ Auth::user()->name }}</h3>
                          </div>
                    </div>

                        <div class="py-4">
                          <p class="clearfix">
                            <span class="float-left"> Username </span>
                            <span class="float-right text-muted"> {{Auth::user()->username}} </span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left"> Mobile </span>
                            <span class="float-right text-muted"> {{Auth::user()->mobile }} </span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left"> Email </span>
                            <span class="float-right text-muted"> {{Auth::user()->email }} </span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left"> Department </span>
                            <span class="float-right text-muted"> {{ Auth::user()->department->name }} </span>
                          </p>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Change Password</h4>
                    <form class="forms-sample" method="post" action="{{route('password', Auth::user()->id)}}">
                    	{{ csrf_field() }}
                    	{{ method_field('PUT') }}
                      <input type="hidden" name="selfuser" value="0">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}" id="exampleInputPassword1" name="password" required="required" placeholder="Password">
                         @if ($errors->has('password'))
                              <label class="error mt-2 text-danger" for="$errors->has('password')">{{ $errors->first('password') }}</label>
                              @endif
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputConfirmPassword1" name="password_confirmation" required="required" placeholder="Password">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
    		
    	</div>
    </div>
 <!-- content-wrapper ends -->
@endsection
@section('js')
<!-- <script src="{{ asset('assets') }}/vendors/x-editable/bootstrap-editable.min.js"></script> -->
<script src="{{ asset('assets') }}/vendors/sweetalert/sweetalert.min.js"></script>
@parent
<!-- <script src="{{ asset('assets') }}/js/x-editable.js"></script> -->
  @if(session('status'))
<script>
    $(document).ready(function() {
      'use strict';
      resetToastPosition();
      $.toast({
        heading: 'Success',
        text: "{{ session('status') }}",
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#f96868',
        position: 'top-right'
    });

      function resetToastPosition() 
      {
      $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
      $(".jq-toast-wrap").css({
        "top": "",
        "left": "",
        "bottom": "",
        "right": ""
      }); //to remove previous position style
  }

        });
    </script>
@endif
@endsection