@extends('layouts.app')

@section('content')
    <div class="content-wrapper pb-0">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Orders Completed</h4>
                    
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>Order Id</th>
                              <th>Customer Detail</th>
                              <th>Address</th>
                              <th>Products Detail</th>
                              <th>Rider Detail</th>
                              <th>Created On</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($orders as $order)
                            <tr>
                              <td><a href="javascript" data-toggle="modal" data-target="#orderdetailModal" data-whatever="{{$order->id}}" data-lead="{{ $order->lead }}" data-order="{{ $order }}" data-doctor="{{ $order->doctor }}" data-products="{{$order->orderproducts}}">{{ $order->id }}</a></td>
                              <td>{{$order->customer_name}} <br><br> {{$order->customer_number}}</td>
                              <td style="white-space: normal;line-height: normal;">{{ $order->customer_address}}</td>
                              <td style="white-space: normal;line-height: normal;">@foreach($order->orderproducts as $product) <b>Medi:</b> {{$product->medicine_name}} <b>/ Qty:</b>  {{$product->quantity}}<br>@endforeach</td>
                              <td>@if($order->user_id != null){{ $order->user->name }}<br><br>{{ $order->user->mobile }} @endif</td>
                               <td class="text-right">{{ $order->created_at}}</td>
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
@if(session('Message'))
<script>
    $(document).ready(function() {
      'use strict';
      resetToastPosition();
      $.toast({
        heading: 'Success',
        text: "{{ session('Message') }}",
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