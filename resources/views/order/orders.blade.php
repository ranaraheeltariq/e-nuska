@extends('layouts.app')

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
                              <th>Status</th>
                              <th>Created On</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($orders as $order)
                              @switch($order->status_id)
                              @case(4)
                              @php $badge = 'badge-warning' @endphp
                              @break
                              @case(5)
                              @php $badge = 'badge-info' @endphp
                              @break
                              @case(6)
                              @php $badge = 'badge-dark' @endphp
                              @break
                              @case(7)
                              @php $badge = 'badge-danger' @endphp
                              @break
                              @default
                              @php $badge = 'badge-success' @endphp
                              @endswitch
                            <tr>
                              <td><a href="javascript" data-toggle="modal" data-target="#orderdetailModal" data-whatever="{{$order->id}}" data-lead="{{ $order->lead }}" data-order="{{ $order }}" data-doctor="{{ $order->doctor }}" data-products="{{$order->orderproducts}}">{{ $order->id }}</a></td>
                              <td><a href="javascript" data-toggle="modal" data-target="#detailModal" data-whatever="{{$order->lead_id}}" data-lead="{{ $order->lead }}" data-doctor="{{ $order->doctor }}" data-remarks="{{$order->lead->remarks}}" data-products="{{$order->lead->products}}">{{ $order->lead_id }}</a></td>
                              <td>{{$order->customer_name}} <br><br> {{$order->customer_number}}</td>
                              <td style="white-space: normal;line-height: normal;">{{ $order->customer_address}}</td>
                              <td style="white-space: normal;line-height: normal;">@foreach($order->orderproducts as $product) <b>Medi:</b> {{$product->medicine_name}} <b>/ Qty:</b>  {{$product->quantity}}<br>@endforeach</td>
                              <td>{{ $order->doctor->doctor_name }}<br><br>{{ $order->doctor->doctor_number }} </td>
                              <td>
                                <label class="badge {{$badge}}">{{$order->status->status}}</label>
                              </td>
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