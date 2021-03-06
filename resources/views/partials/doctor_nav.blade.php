<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href=""><img src="{{asset('img/logo.png')}}" data-retina="true" alt="" ><!-- <h4 style="color: white !important">Fokzmedics</h4> --></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{route('doctor.index')}}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltips" data-placement="right" >
          <a class="nav-link" href="{{route('doctor.schedule')}}" >
            <i class="fa fa-fw fa-cubes"></i>
            <span class="nav-link-text">Set Working Schedule</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Fix consulting hours">
          <a class="nav-link" href="{{route('doctor.register')}}" >
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Register Patient</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Fix consulting hours">
          <a class="nav-link" id="notify_new_book" href="{{route('doctor.bookings')}}" >
            <i class="fa fa-fw fa-envelope-open"></i>
            <span class="nav-link-text">Bookings <span class="badge badge-pill badge-danger notify_new_book" style="display: none;"></span> </span>
          </a>
        </li>
          
{{-- 
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Bookings">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProfile" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-money"></i>
            <span class="nav-link-text">Purse</span>
          </a>
           <ul class="sidenav-second-level collapse" id="collapseProfile">
            <li>
              <a href="#" data-toggle="modal" data-target="#balance-modal" onclick="return false;">Balance</a>
            </li>
          <li>
              <a href="transactions">Transaction</a>
            </li>
          </ul>
        </li> --}}
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Reviews">
          <a class="nav-link" href="{{route('doctor.reviews')}}">
            <i class="fa fa-fw fa-star"></i>
            <span class="nav-link-text">What Patients Says  </span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="licence">
          <a class="nav-link" href="{{route('doctor.licence')}}">
            <i class="fa fa-fw fa-book"></i>
            <span class="nav-link-text">Upload licence </span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Profile">
          <a class="nav-link" href="{{route('doctor.profile')}}">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">My Profile  </span>
          </a>
        </li>
       
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
       
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2 click_notify_chat_doctor" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary count_chat">0</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle count_chat_ind" style="display: none;"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <div class="show-chat-notify"></div>
          </div>
        </li>
        <li class="nav-item dropdown" id="notify-drug-presc">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">New Drug Messages
              <span class="badge badge-pill badge-warning conunt-new-drug-test" style="display: none;">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle count-drug-show" style="display: none;"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Drug Prescription:</h6>
            <div class="dropdown-divider"></div>
           <div class="notify-drug-test-dropdown"></div>
          </div>
        </li>
        <li class="nav-item">
          <!-- <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control search-top" type="text" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form> -->

        </li>
        <li id="user">
              <a href="doctor-profile">
                <figure><img src="{{!empty(auth()->user()->image)?asset(auth()->user()->image):asset('img/user.png')}}" alt="wew" style="border-radius: 50%" width="30px" height="30px"></figure>
              
              </a>
            </li>
        <li class="nav-item">
        <a class="nav-link">
       </i>{{auth()->user()->fullname}}</a></li>
        <li class="nav-item">
          

            <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fa fa-fw fa-sign-out"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </li>
      </ul>
    </div>
  </nav>