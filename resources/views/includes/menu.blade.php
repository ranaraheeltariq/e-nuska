      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
              <div class="nav-profile-image">
                <!-- <img src="https://sehat.com.pk/product_images/sehattmlogo.png" alt="profile"> -->
                <!--change to offline or busy as needed-->
              </div>
            </a>
          </li>

          <li class="pt-2 pb-1">
            <span class="nav-item-head">E Nuska</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="mdi mdi-compass-outline menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if(in_array(Auth::user()->department->name, array('Pharmacy','Admin','Doctors') ))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('lead.add') }}">
              <i class="mdi mdi-cart-plus menu-icon"></i>
              <span class="menu-title">Add Lead</span>
            </a>
          </li>
          @endif 
          @if(in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center') ))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#leads" aria-expanded="false" aria-controls="leads">
              <i class="mdi mdi-chart-areaspline menu-icon"></i>
              <span class="menu-title">Leads</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="leads">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('leads') }}">All Leads</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('leads.pending') }}">Pending</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('leads.ordercreated') }}">Order Created</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('leads.close') }}">Close</a></li>
              </ul>
            </div>
          </li>
          @endif
          @if(in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center','Riders') ))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders">
              <i class="mdi mdi-cart menu-icon"></i>
              <span class="menu-title">Orders</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="orders">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('orders') }}">All Orders</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('orders.beingprocess') }}">Being Process</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('orders.shipped') }}">Shipped, Invoice Pending</a></li>
                @if(Auth::user()->approval_auth == 'Yes')
                <li class="nav-item"> <a class="nav-link" href="{{ route('orders.approval') }}">Approval Pending</a></li>
                @endif
                <li class="nav-item"> <a class="nav-link" href="{{ route('orders.completed') }}">Completed</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('orders.cancelled') }}">Cancelled</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('orders.refund') }}">Refund</a></li>
              </ul>
            </div>
          </li>
          @endif
          @if(in_array(Auth::user()->department->name, array('Pharmacy','Admin') ))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#doctors" aria-expanded="false" aria-controls="doctors">
              <i class="mdi mdi-medical-bag menu-icon"></i>
              <span class="menu-title">Doctors</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="doctors">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('doctor.add') }}">Add Doctors</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('doctors') }}">Doctors</a></li>
              </ul>
            </div>
          </li>
          @endif
          @if(Auth::user()->department->name == 'Admin')
           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="false" aria-controls="report">
              <i class="mdi mdi-transcribe-close menu-icon"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="report">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('userlogs') }}">Administration Log</a></li>
              </ul>
            </div>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#department" aria-expanded="false" aria-controls="department">
              <i class="mdi mdi-account-network menu-icon"></i>
              <span class="menu-title">Department</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="department">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('department.add') }}">Add Department</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('departments') }}">Departments</a></li>
              </ul>
            </div>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Users</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('user.add') }}">Add New User</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('users') }}">Users</a></li>
              </ul>
            </div>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ route('profile') }}">
              <i class="mdi mdi-account-settings menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
