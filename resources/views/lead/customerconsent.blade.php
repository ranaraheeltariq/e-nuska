@extends('layouts.app')

@section('content')
    <div class="content-wrapper pb-0">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <h4 class="card-title">Leads</h4>
              @if(in_array(Auth::user()->department->name, array('Pharmacy','Admin','Doctors') ))
              <a class="float-right btn btn-info btn-sm mb-1" href="{{ route('lead.add') }}">Add Lead</a>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                      <th>Lead #</th>
                      <th>Customer Detail</th>
                      <th>Products Detail</th>
                      <th>Doctor Detail</th>
                      <th>Agent Assigned</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($leads as $lead)
                    <tr>
                      <td><a href="javascript" data-toggle="modal" data-target="#detailModal" data-whatever="{{$lead->id}}" data-lead="{{ $lead }}" data-doctor="{{ $lead->doctor }}" data-remarks="{{$lead->remarks}}" data-products="{{$lead->products}}">{{ $lead->id }}</a></td>
                      <td>{{ $lead->customer_name }}<br><br>{{ $lead->customer_number }}</td>
                      <td style="white-space: normal;line-height: normal;">@foreach($lead->products as $product) <b>Medi:</b> {{$product->medicine_name}} <b>/ Qty:</b>  {{$product->quantity}}<br>@endforeach</td>
                      <td>{{ $lead->doctor->doctor_name }}<br><br>{{ $lead->doctor->doctor_number }}</td>
                      <td>{{ $lead->user->name }}</td>
                      <td class="text-right">
                         @if(in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center') ))
                          <a href="{{ route('lead.createorder',$lead->id) }}" class="btn btn-primary"><i class="mdi mdi-check text-success"></i>Create Order </a>
                       
                        <button class="btn btn-danger notavailable" data-toggle="modal" data-target="#remarks" data-whatever="{{$lead->id}}" data-link="{{ route('remarks.save') }}"><i class="mdi mdi-pencil text-primary"></i> Remarks </button>
                        <br><br>
                        <button class="btn btn-info notavailable" data-toggle="modal" data-target="#notinterested" data-whatever="{{$lead->id}}" data-link="{{ route('lead.update',$lead->id) }}"><i class="mdi mdi-close text-danger"></i> Not Interested </button>
                        <button class="btn btn-warning agent" data-toggle="modal" data-target="#agent" data-whatever="{{$lead->id}}" data-user="{{ $lead->user_id }}" data-link="{{ route('lead.update',$lead->id) }}"><i class="mdi mdi-phone text-primary"></i> Assign Agent </button>
                        @endif
                        @if(in_array(Auth::user()->department->name, array('Pharmacy','Admin') ))
                        <br><br>
                        <a href="{{ route('lead.edit',$lead->id) }}" class="btn btn-primary"><i class="mdi mdi-check text-success"></i>Edit Lead </a>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
          <!-- content-wrapper ends -->
@endsection
@section('js')
@parent
<script src="{{ asset('assets') }}/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="{{ asset('assets') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="{{ asset('assets') }}/js/data-table.js"></script>
@if(session('Message'))
<script>
    $(document).ready(function() {
      'use strict';
      resetToastPosition();
      $.toast({
        heading: 'Warning',
        text: "{{ session('Message') }}",
        showHideTransition: 'slide',
        icon: 'warning',
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