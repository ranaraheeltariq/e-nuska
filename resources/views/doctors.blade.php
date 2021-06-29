@extends('layouts.app')
@section('css')
@parent
@endsection
@section('content')
<div class="content-wrapper">
		<div class="card">
			<div class="card-body">
				<div class="d-flex mb-4">
					<h5 class="mr-2 font-weight-semibold border-right pr-2 mr-2">Doctors</h5>
					<h5 class="font-weight-semibold">{{ $doctors->count() }}</h5>
				</div>
				<div class="row mx-sm-0">
					@foreach($doctors as $doctor)
					<div class="col-md-6 mb-5 pt-2 border px-0">
						<div class="card rounded shadow-none">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12 col-lg-12 d-lg-flex">
										<div class="wrapper pl-lg-4">
											<div class="wrapper d-flex align-items-center">
												<h4 class="mb-0 font-weight-semibold">{{ $doctor->doctor_name }}</h4>
											</div>
											<div class="wrapper d-flex align-items-center pt-2 font-weight-semibold text-muted">
												<p class="mb-0 text-muted">{{ $doctor->doctor_number }} {{ $doctor->doctor_clinic != null ? '- '.$doctor->doctor_clinic : '' }}</p>
											</div>
											<div class="wrapper d-flex align-items-start pt-4">
												<a href="{{ route('doctor.edit',$doctor->id) }}" class="btn btn-primary mr-2">
													<i class="mdi mdi-pencil-box-outline icon-sm"></i> Edit Doctor
												</a>
												<form id="ship" action="{{ route('doctor.remove',$doctor->id) }}" method="post">
													{{ csrf_field() }}
													@method('DELETE')
                          <button type="submit" name="submit" class="btn btn-warning mr-2"><i class="mdi mdi-account-remove icon-sm"></i> Remove </button>   
                        </form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
 <!-- content-wrapper ends -->
@endsection
@section('js')
<script src="{{ asset('assets') }}/vendors/sweetalert/sweetalert.min.js"></script>
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