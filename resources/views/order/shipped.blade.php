@extends('layouts.app')

@section('content')
    <div class="content-wrapper pb-0">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Orders Shipped</h4>
                    
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>Order #</th>
                              <th>Customer Detail</th>
                              <th>Address</th>
                              <th>Products Detail</th>
                              <th>Rider Detail</th>
                              <th>Shipped On</th>
                              @if(in_array(Auth::user()->department->name, array('Pharmacy','Admin') ))
                              <th>Actions</th>
                              @endif
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($orders as $order)
                            <tr>
                              <td><a href="javascript" data-toggle="modal" data-target="#orderdetailModal" data-whatever="{{$order->id}}" data-lead="{{ $order->lead }}" data-order="{{ $order }}" data-doctor="{{ $order->doctor }}" data-products="{{$order->orderproducts}}">{{ $order->id }}</a></td>
                              <td>{{$order->customer_name}} <br><br> {{$order->customer_number}}</td>
                              <td style="white-space: normal;line-height: normal;">{{ $order->customer_address}}</td>
                              <td style="white-space: normal;line-height: normal;">@foreach($order->orderproducts as $product) <b>Medi:</b> {{$product->medicine_name}} <b>/ Qty:</b>  {{$product->quantity}}<br>@endforeach</td>
                              <td>{{ $order->user->name }}<br><br>{{ $order->user->mobile }} </td>
                              <td>{{ $order->updated_at }}</td>
                              @if(in_array(Auth::user()->department->name, array('Pharmacy','Admin') ))
                              <td class="text-right">
                                <a href="{{ route('orders.edit',$order->id) }}" class="btn btn-light"><i class="mdi mdi-pencil text-success"></i>Edit Order </a>
                                <br><br>
                                <button class="btn btn-light uploadinvoice" data-toggle="modal" data-target="#uploadinvoice" data-whatever="{{$order->id}}" data-link="{{ route('orders.update',$order->id) }}"><i class="mdi mdi-briefcase-upload text-primary"></i> Upload Invoice </button>
                                <br><br>
                                <form id="refund" action="{{ route('orders.update',$order->id) }}" method="post">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}
                                  <input type="hidden" name="status_id" value="7">
                                  <button type="submit" name="submit" class="btn btn-light"><i class="mdi mdi-check text-danger"></i> Order Refunded </button>   
                                </form>
                              </td>
                              @endif
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
@parent
<script src="{{ asset('assets') }}/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="{{ asset('assets') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="{{ asset('assets') }}/js/data-table.js"></script>
<script src="{{ asset('assets') }}/vendors/sweetalert/sweetalert.min.js"></script>
<script src="{{ asset('assets') }}/js/file-upload.js"></script>
<script type="text/javascript">
      $("form#refund").on("submit", function(){
        return confirm("Are you sure order Amount is refunded?");
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