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
                    <h4 class="card-title">Create Order</h4>
                    <form class="form-sample create-order" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="lead" value="{{ $lead->id }}">
                      <input type="hidden" name="status_id" value="2">
                      <p class="card-description"> Create Order form </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row" id="customer_name_error">
                            <label class="col-sm-3 col-form-label">Customer Name <span>*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control{{ $errors->has('customer_name') ? ' form-control-danger' : '' }}" type="text" name="customer_name" id="customer_name" placeholder="Enter Customer Name" value="{{ $lead->customer_name }}" required="required" />
                              <label class="error mt-2 text-danger" id="err_customer_name" style="display: none;"></label>
                            </div>
                          </div>
                        </div>
                         <div class="col-md-6">
                          <div class="form-group row" id="number_error">
                            <label class="col-sm-3 col-form-label">Customer Phone <span>*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control {{ $errors->has('number') ? ' form-control-danger' : '' }}" type="text" name="number" id="number" placeholder="Enter Customer Phone number" value="{{ $lead->customer_number }}"  required="required" />
                             <label class="error mt-2 text-danger" id="err_number" style="display: none;"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row" id="address_error">
                            <label class="col-sm-3 col-form-label">Customer Address <span>*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control {{ $errors->has('address') ? ' form-control-danger' : '' }}" type="text" name="address" id="address" placeholder="Enter Customer Address"  required="required" />
                             <label class="error mt-2 text-danger" id="err_address" style="display: none;"></label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row" id="doctor_error">
                            <label class="col-sm-3 col-form-label">Doctor</label>
                            <div class="col-sm-9">
                              <select class="js-example-basic-single" name="doctor" id="doctor" style="width:100%">
                                  <option selected="selected" value="{{ $lead->doctor->id }}">{{ $lead->doctor->doctor_name }} {{ $lead->doctor->doctor_clinic == null ? "" : "(".$lead->doctor->doctor_clinic.")" }}</option>
                                </select>
                              <label class="error mt-2 text-danger" id="err_doctor" style="display: none;"></label>
                            </div>
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
                            <div class="form-group row" id="medicine_name_error">
                              <label class="col-sm-3 col-form-label">Medicine Name <span>*</span></label>
                              <div class="col-sm-9">
                                <input class="form-control{{ $errors->has('medicine_name') ? ' form-control-danger' : '' }}" type="text" name="medicine_name[]" id="medicine_name" placeholder="Enter Medicine Name" value="{{ $product->medicine_name }}" required="required" />
                               <label class="error mt-2 text-danger" id="err_medicine_name" style="display: none;"></label>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group row" id="quantity_error">
                              <label class="col-sm-3 col-form-label">Quantity <span>*</span></label>
                              <div class="col-sm-9">
                                <input class="form-control{{ $errors->has('quantity') ? ' form-control-danger' : '' }}" type="number" name="quantity[]" id="quantity" min="1" placeholder="Enter Medicine Quantity" value="{{ $product->quantity }}" required="required" />
                               <label class="error mt-2 text-danger" id="err_quantity" style="display: none;"></label>
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
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
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


       $('.create-order').on('submit', function(event){
        event.preventDefault();
        $.ajax({
           url:"{{ route('orders.save') }}",
           method:"POST",
           data:new FormData(this),
           dataType:'JSON',
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
            // console.log(data);
            // console.log(data.status);
            showSuccessToast(data.status);
            window.setTimeout(function() {
              window.location.href = "{{ route('leads.ordercreated') }}";
            }, 3000);
           },
           error:function(data)
           {
              // console.log(data.responseJSON.errors);
              var errors = $.parseJSON(data.responseText);
                    $.each(errors.errors, function (key, val) {
                      $("#" + key + "_error").addClass('has-danger');
                      $("#err_"+  key).text(val[0]);
                      $("#err_"+  key).show();
                    });
           }
        })
       });


      function showSuccessToast(msg)
      {
        'use strict';
          resetToastPosition();
          $.toast({
            heading: 'Success',
            text: msg,
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-right'
          })
      }

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
@endsection