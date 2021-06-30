@extends('layouts.app')

@section('content')
    <div class="content-wrapper pb-0">
    	<div class="row">
    		<div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <form class="form-sample" method="post" action="{{route('password',$user->id)}}" enctype="multipart/form-data">
                      <p class="card-description"> Enter User Personal info </p>
                      <div class="row">
                        {{ csrf_field() }}
                        @method('put')
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" name="name" value="{{ $user->name }}">
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
                              <input type="text" class="form-control{{ $errors->has('username') ? ' form-control-danger' : '' }}" disabled="disabled" name="username" value="{{ $user->username }}">
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
                              <input type="text" class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}" disabled="disabled" name="email" value="{{ $user->email }}">
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
                              <input type="password" class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}" name="password">
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
                                <option value="">Select Department..</option>
                                @foreach(App\Models\Department::all() as $department)
                                @php $select = $user->department_id == $department->id ? 'selected=selected' : '' @endphp
                                <option {{ $select }} value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                              </select>
                               @if ($errors->has('department_id'))
                              <label class="error mt-2 text-danger" for="$errors->has('department_id')">{{ $errors->first('department_id') }}</label>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control{{ $errors->has('mobile') ? ' form-control-danger' : '' }}" name="mobile" value="{{ $user->mobile }}">
                              @if ($errors->has('mobile'))
                              <label class="error mt-2 text-danger" for="$errors->has('mobile')">{{ $errors->first('mobile') }}</label>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Profile Image</label>
                               <input type="file" name="image" id="image" class="file-upload-default">
                            <div class="input-group col-sm-9">
                               <input type="text" class="form-control{{ $errors->has('image') ? ' form-control-danger' : '' }} file-upload-info" disabled placeholder="Invoice file Upload">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                             </span>
                            </div>
                            @if($errors->has('image'))
                             <label class="error mt-2 text-danger" for="$errors->has('image')">{{ $errors->first('image') }}</label>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Approval Authority</label>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="approval_auth" id="membershipRadios1" value="Yes" > Yes <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="approval_auth" id="membershipRadios2" value="No"> No <i class="input-helper"></i></label>
                              </div>
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
@section('js')
<script src="{{ asset('assets') }}/js/file-upload.js"></script>
<script src="{{ asset('assets') }}/vendors/sweetalert/sweetalert.min.js"></script>
<script src="{{ asset('assets') }}/vendors/jquery-validation/jquery.validate.min.js"></script>
@parent
<script src="{{ asset('assets') }}/js/form-validation.js"></script>
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