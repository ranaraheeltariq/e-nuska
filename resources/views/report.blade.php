@extends('layouts.app')

@section('content')
    <div class="content-wrapper pb-0">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Orders Awaiting Payment</h4>
                    
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>User Name</th>
                              <th>Activiaty</th>
                              <th>Updated On</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($logs as $log)
                            <tr>
                              <td>{{$log->user->name}}</td>
                              <td>{{ $log->description }}</td>
                              <td>{{$log->created_at}}</td>
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
@endsection