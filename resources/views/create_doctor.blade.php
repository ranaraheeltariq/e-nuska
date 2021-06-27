@extends('layouts.app')

@section('content')
    <div class="content-wrapper pb-0">
    	<div class="row">
    		<div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add New Doctor</h4>
                    <form class="form-sample" method="post" action="{{route('doctor.save')}}">
                      <p class="card-description"> Enter Doctor Personal info </p>
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" name="name" required="required">
                              @if ($errors->has('name'))
                              <label class="error mt-2 text-danger" for="$errors->has('name')">{{ $errors->first('name') }}</label>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control{{ $errors->has('number') ? ' form-control-danger' : '' }}" name="number" required="required">
                              @if ($errors->has('number'))
                              <label class="error mt-2 text-danger" for="$errors->has('number')">{{ $errors->first('number') }}</label>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Clinic Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control{{ $errors->has('clinic_name') ? ' form-control-danger' : '' }}" name="clinic_name">
                              @if ($errors->has('clinic_name'))
                              <label class="error mt-2 text-danger" for="$errors->has('clinic_name')">{{ $errors->first('clinic_name') }}</label>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
              
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
    		
    	</div>
    </div>
 <!-- content-wrapper ends -->
@endsection
<script src="{{ asset('assets') }}/vendors/sweetalert/sweetalert.min.js"></script>
@section('js')
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