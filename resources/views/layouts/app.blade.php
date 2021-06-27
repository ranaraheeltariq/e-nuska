<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @section('css')
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/jquery-bar-rating/css-stars.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/jquery-toast-plugin/jquery.toast.min.css">
    <!-- End plugin css for this page -->
    @show
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo_1/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
        @auth
        @include('includes.menu')
        <div class="container-fluid page-body-wrapper">
        @include('includes.header')
        <div class="main-panel">
        @endauth
       @yield('content')
        @auth
        <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{ date('Y') }} <a href="https://apothecare.com.pk/" target="_blank">ApotheCare (Pvt) Ltd</a>. All rights reserved.</span>
              
            </div>
          </footer>
          <!-- partial -->
            </div>
          <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
            @include('includes.modals')
         @endauth
    </div>
     <!-- container-scroller -->
     
    <!-- plugins:js -->
    <script src="{{ asset('assets') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets') }}/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets') }}/js/off-canvas.js"></script>
    <script src="{{ asset('assets') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('assets') }}/js/misc.js"></script>
    {{-- <script src="{{ asset('assets') }}/js/settings.js"></script> --}}
    <script src="{{ asset('assets') }}/js/todolist.js"></script>
    <script src="{{ asset('assets') }}/js/modal.js"></script>
    <!-- endinject -->
    @section('js')
    <!-- Custom js for this page -->
   @show
    <!-- End custom js for this page -->
  </body>
</html>


