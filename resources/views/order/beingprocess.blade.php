@extends('layouts.app')
@section('css')
  @parent
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
@endsection
@section('content')
    <div class="content-wrapper pb-0">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Orders Being Process</h4>
                    
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>Order Id</th>
                              <th>Lead Id</th>
                              <th>Customer Detail</th>
                              <th>Address</th>
                              <th>Products Detail</th>
                              <th>Doctor Detail</th>
                              <th>Created On</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($orders as $order)
                            <tr>
                              <td><a href="javascript" data-toggle="modal" data-target="#orderdetailModal" data-whatever="{{$order->id}}" data-lead="{{ $order->lead }}" data-order="{{ $order }}" data-doctor="{{ $order->doctor }}" data-products="{{$order->orderproducts}}">{{ $order->id }}</a></td>

                              <td><a href="javascript" data-toggle="modal" data-target="#detailModal" data-whatever="{{$order->lead_id}}" data-lead="{{ $order->lead }}" data-doctor="{{ $order->doctor }}" data-remarks="{{$order->lead->remarks}}" data-products="{{$order->lead->products}}">{{ $order->lead_id }}</a></td>

                              <td>{{$order->customer_name}} <br><br> {{$order->customer_number}}</td>

                              <td style="white-space: normal;line-height: normal;">{{ $order->customer_address}}</td>

                              <td style="white-space: normal;line-height: normal;">@foreach($order->orderproducts as $product) <b>Medi:</b> {{$product->medicine_name}} <b>/ Qty:</b>  {{$product->quantity}}<br>@endforeach</td>

                              <td>{{ $order->doctor->doctor_name }}<br><br>{{ $order->doctor->doctor_number }} </td>

                              <td>{{ $order->created_at}}</td>
                              <td class="text-right">
                              @if(in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center') ))
                                <a href="{{ route('orders.edit',$order->id) }}" class="btn btn-light"><i class="mdi mdi-pencil text-success"></i>Edit Order </a>
                                @if($order->user_id == null)
                                <button class="btn btn-light notavailable" data-toggle="modal" data-target="#rider" data-whatever="{{$order->id}}" data-link="{{ route('orders.update',$order->id) }}"><i class="mdi mdi-motorbike text-primary"></i> Assign Rider </button>
                                @endif
                                <br><br>
                                @endif
                                 <form id="ship" action="{{ route('orders.update',$order->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="status_id" value="5">
                                    <button type="submit" name="submit" class="btn btn-light"><i class="mdi mdi-briefcase-check text-primary"></i> Shipped </button>   
                                  </form>
                                  <br>
                                    <form id="cencel" action="{{ route('orders.update',$order->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="status_id" value="6">
                                    <button type="submit" name="submit" class="btn btn-light"><i class="mdi mdi-minus-circle-outline text-danger"></i> Order Cancel </button>   
                                  </form>
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
        </div>
          <!-- content-wrapper ends -->
@endsection
@section('js')
<script src="{{ asset('assets') }}/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="{{ asset('assets') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="{{ asset('assets') }}/vendors/select2/select2.min.js"></script>
<script src="{{ asset('assets') }}/js/data-table.js"></script>
<script src="{{ asset('assets') }}/vendors/sweetalert/sweetalert.min.js"></script>
@parent
<script src="{{ asset('assets') }}/js/select2.js"></script>
<script type="text/javascript">
      $("form#ship").on("submit", function(){
        return confirm("Are you sure order is ready to ship?");
    });
       $("form#cencel").on("submit", function(){
        return confirm("Are you sure order is Cancelled?");
    });
</script>
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
@endsection