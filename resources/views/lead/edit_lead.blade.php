@extends('layouts.app')
@section('css')
  @parent
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
@endsection
@section('content')
    <div class="content-wrapper pb-0">

    	<div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Lead</h4>
                    <form class="form-sample" action="{{ route('lead.update',$lead->id) }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      @method('PUT')
                      <p class="card-description"> Edit Lead form </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Customer Name <span>*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control{{ $errors->has('customer_name') ? ' form-control-danger' : '' }}" type="text" name="customer_name" id="customer_name" placeholder="Enter Customer Name" value="{{ $lead->customer_name }}" required="required" />
                                 @if ($errors->has('customer_name'))
                                 <label class="error mt-2 text-danger" for="$errors->has('customer_name')">{{ $errors->first('customer_name') }}</label>
                              @endif
                            </div>
                          </div>
                        </div>
                         <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Customer Phone <span>*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control {{ $errors->has('number') ? ' form-control-danger' : '' }}" type="text" name="number" id="number" placeholder="Enter Customer Phone number" value="{{ $lead->customer_number }}"  required="required" />
                                 @if($errors->has('number'))
                                     <label class="error mt-2 text-danger" for="$errors->has('number')">{{ $errors->first('number') }}</label>
                                  @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Doctor</label>
                            <div class="col-sm-9">
                              <select class="js-example-basic-single" name="doctor" id="doctor" style="width:100%">
                                @foreach(App\Models\Doctor::all() as $doctor)
                                @php $select = $doctor->id == $lead->doctor_id ? 'selected=selected' : '' @endphp
                                  <option {{ $select }} value="{{ $doctor->id }}">{{ $doctor->doctor_name }} {{ $doctor->doctor_clinic == null ? "" : "(".$doctor->doctor_clinic.")" }}</option>
                                  @endforeach
                                </select>
                                  @if($errors->has('doctor'))
                                     <label class="error mt-2 text-danger" for="$errors->has('doctor')">{{ $errors->first('doctor') }}</label>
                                  @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                              <select class="js-example-basic-single" name="status" id="status" style="width:100%">
                                @foreach(App\Models\Status::all()->take(3) as $status)
                                @php $select = $status->id == $lead->status_id ? 'selected=selected' : '' @endphp
                                  <option {{ $select }} value="{{ $status->id }}">{{ $status->status }}</option>
                                  @endforeach
                                </select>
                                @if($errors->has('status'))
                                     <label class="error mt-2 text-danger" for="$errors->has('status')">{{ $errors->first('status') }}</label>
                                  @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row" id="file1_error">
                              <label class="col-sm-3 col-form-label">Prescription</label>
                               <input type="file" name="file1" id="file1" class="file-upload-default">
                            <div class="input-group col-sm-9">
                               <input type="text" class="form-control{{ $errors->has('file1') ? ' form-control-danger' : '' }} file-upload-info" disabled placeholder="Prescription Upload">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                             </span>
                            </div>
                            @if($errors->has('file1'))
                             <label class="error mt-2 text-danger" for="$errors->has('file1')">{{ $errors->first('file1') }}</label>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Prescription</label>
                               <input type="file" name="file2" id="file2" class="file-upload-default">
                            <div class="input-group col-sm-9">
                               <input type="text" class="form-control{{ $errors->has('file2') ? ' form-control-danger' : '' }} file-upload-info" disabled placeholder="Prescription Upload">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                             </span>
                            </div>
                            @if($errors->has('file2'))
                             <label class="error mt-2 text-danger" for="$errors->has('file2')">{{ $errors->first('file2') }}</label>
                            @endif
                            </div>
                        </div>
                      </div>

                      <p class="card-description"> Medicine </p>
                      <div class="col-md-12">
                        <a href="javascript:void(0);" id="add-field" class="btn btn-primary float-right"><i class="mdi mdi-plus-circle-outline"></i></a>
                      </div>
                      <div class="field_wrapper">
                        @foreach($lead->products as $product)
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Medicine Name <span>*</span></label>
                              <div class="col-sm-9">
                                <input class="form-control{{ $errors->has('medicine_name') ? ' form-control-danger' : '' }}" type="text" name="medicine_name[]" id="medicine_name" placeholder="Enter Medicine Name" value="{{ $product->medicine_name }}" required="required" />
                                @if($errors->has('medicine_name'))
                                     <label class="error mt-2 text-danger" for="$errors->has('medicine_name')">{{ $errors->first('medicine_name') }}</label>
                                  @endif
                              </div>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Quantity <span>*</span></label>
                              <div class="col-sm-9">
                                <input class="form-control{{ $errors->has('quantity') ? ' form-control-danger' : '' }}" type="number" name="quantity[]" id="quantity" min="1" placeholder="Enter Medicine Quantity" value="{{ $product->quantity }}" required="required" />
                                @if($errors->has('quantity'))
                                     <label class="error mt-2 text-danger" for="$errors->has('quantity')">{{ $errors->first('quantity') }}</label>
                                  @endif
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <a class="btn btn-danger remove_button" href="javascript:void(0);"><i class="mdi mdi-delete"></i></a>
                          </div>
                        </div>
                      @endforeach
                      </div>
                     
                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
    </div>
          <!-- content-wrapper ends -->
@endsection
@section('js')
<script src="{{ asset('assets') }}/js/file-upload.js"></script>
 <script src="{{ asset('assets') }}/vendors/select2/select2.min.js"></script>
<script src="{{ asset('assets') }}/vendors/jquery-validation/jquery.validate.min.js"></script>
@parent
<script src="{{ asset('assets') }}/js/select2.js"></script>
<script src="{{ asset('assets') }}/js/form-validation.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      var maxField = 10;
      var addButton = $('#add-field');
      var wrapper = $('.field_wrapper');
      var fieldHTML = '<div class="row"><div class="col-md-5"><div class="form-group row" id="medicine_name_error"><label class="col-sm-3 col-form-label">Medicine Name <span>*</span></label><div class="col-sm-9"><input class="form-control" type="text" name="medicine_name[]" id="medicine_name" placeholder="Enter Medicine Name" required="required" /><label class="error mt-2 text-danger" id="err_medicine_name" style="display: none;"></label></div></div></div><div class="col-md-5"><div class="form-group row" id="quantity_error"><label class="col-sm-3 col-form-label">Quantity <span>*</span></label><div class="col-sm-9"><input class="form-control" type="number" name="quantity[]" id="quantity" min="1" placeholder="Enter Medicine Quantity" required="required" /><label class="error mt-2 text-danger" id="err_quantity" style="display: none;"></label></div></div></div><div class="col-md-2"><a class="btn btn-danger remove_button" href="javascript:void(0);"><i class="mdi mdi-delete"></i></a></div></div>';
      var x = 1;
      $(addButton).click(function(){
        if(x < maxField){
        //Check maximum number of input fields         
        x++;  
            $(wrapper).append(fieldHTML); //Add field html
          }
        });
      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e){
          e.preventDefault();
          $(this).parent('div').parent('div').remove(); //Remove field html
          x--; //Decrement field counter
      });
    });
  </script>
@endsection