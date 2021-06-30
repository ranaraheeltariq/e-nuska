@extends('layouts.app')
@section('css')
@parent
@endsection

@section('content')
    <div class="content-wrapper pb-0">
    	<div class="row">
    		<div class="col-lg-6 grid-margin stretch-card">
               <div class="card">
                  <div class="card-body">
               
                  	<div class="d-flex justify-content-between">
                          <div class="user-avatar mb-auto">
                            <img src="/images/users/{{ $user->image == null ? 'user-circle.png' : $user->image }}" alt="{{ $user->name }}" class="profile-img img-lg rounded-circle">
                          </div>
                          <div class="wrapper d-flex align-items-center">
                            <h3>{{ $user->name }}</h3>
                          </div>
                    </div>

                        <div class="py-4">
                          <p class="clearfix">
                            <span class="float-left"> Username </span>
                            <span class="float-right text-muted"> {{$user->username}} </span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left"> Mobile </span>
                            <span class="float-right text-muted"> {{$user->mobile }} </span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left"> Email </span>
                            <span class="float-right text-muted"> {{$user->email }} </span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left"> Department </span>
                            <span class="float-right text-muted"> {{ $user->department->name }} </span>
                          </p>
                        </div>
                    </div>
                  </div>
                </div>
    		
    	</div>
    </div>
 <!-- content-wrapper ends -->
@endsection
@section('js')
<script src="{{ asset('assets') }}/vendors/sweetalert/sweetalert.min.js"></script>
@parent
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