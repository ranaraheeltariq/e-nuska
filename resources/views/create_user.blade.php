@extends('layouts.app')

@section('content')
    <div class="content-wrapper pb-0">
    	<div class="row">
    		<div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create New User</h4>
                    <form class="form-sample" method="post" action="{{route('add user')}}">
                      <p class="card-description"> Enter User Personal info </p>
                      <div class="row">
                        {{ csrf_field() }}
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
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control{{ $errors->has('username') ? ' form-control-danger' : '' }}" name="username" required="required">
                              @if ($errors->has('username'))
                              <label class="error mt-2 text-danger" for="$errors->has('username')">{{ $errors->first('username') }}</label>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}" name="email" required="required">
                              @if ($errors->has('email'))
                              <label class="error mt-2 text-danger" for="$errors->has('email')">{{ $errors->first('email') }}</label>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}" name="password" required="required">
                              @if ($errors->has('password'))
                              <label class="error mt-2 text-danger" for="$errors->has('password')">{{ $errors->first('password') }}</label>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9">
                              <select class="form-control{{ $errors->has('department_id') ? ' form-control-danger' : '' }}" name="department_id">
                                <option></option>
                                @foreach(App\Models\Department::all() as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                              </select>
                               @if ($errors->has('department_id'))
                              <label class="error mt-2 text-danger" for="$errors->has('department_id')">{{ $errors->first('department_id') }}</label>
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