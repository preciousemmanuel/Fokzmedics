<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="/"><img src="img/logo.png" data-retina="true" alt="Fokzmdics" > <!-- <h4 style="color: white !important">Fokzmedics</h4> --></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{route('freelancer.index')}}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Fix consulting hours">
          <a class="nav-link" href="{{route('freelancer.register')}}" >
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Register Patient</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Chat history">
          <a class="nav-link" id="notify_new_book" href="{{route('freelancer.chatHistory')}}" >
            <i class="fa fa-fw fa-comment"></i>
            <span class="nav-link-text">Chat Log<span class="badge badge-pill badge-danger notify_new_book" style="display: none;"></span></span>
          </a>
        </li>
       <!-- <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Appointments">
          <a class="nav-link" id="notify_new_book" href="appointments" >
            <i class="fa fa-fw fa-envelope-open"></i>
            <span class="nav-link-text">Appointments<span class="badge badge-pill badge-danger notify_new_book" style="display: none;"></span></span>
          </a>
        </li>-->
        
       
            <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Central Inventory">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseInventory" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cube"></i>
            <span class="nav-link-text">Central Inventory</span>
          </a>
           <ul class="sidenav-second-level collapse" id="collapseInventory">
            <li>
              <a href="{{route('freelancer.centralDrugs')}}">Central Drug Inventory</a>
            </li>
          <li>
              <a href="{{route('freelancer.centralTests')}}">Central Test Inventory</a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Purse">
          <a class="nav-link" href="{{route('freelancer.purse')}}" >
            <i class="fa fa-fw fa-money"></i>
            <span class="nav-link-text">Purse</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Upload licence">
          <a class="nav-link" href="upload-licence" >
            <i class="fa fa-fw fa-book"></i>
            <span class="nav-link-text">Upload licence</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Reviews">
          <a class="nav-link" href="{{route('freelancer.reviews')}}">
            <i class="fa fa-fw fa-star"></i>
            <span class="nav-link-text">What Patients Says  </span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltips" data-placement="right" title="Bookings">
          <a class="nav-link" href="{{route('freelancer.profile')}}">
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
       <!-- <li class="nav-item"><a class="nav-link" href="><i class="fa fa-fw fa-home"></i> Home</a></li>-->
        <li class="nav-item dropdown" id="notify-lab-test">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Notification
              <span class="badge badge-pill badge-primary conunt-new-lab-test" ></span>
            </span>
            <span class="indicator text-primary d-none d-lg-block" >
              <i class="fa fa-fw fa-circle cout-ind-show" style="display: none;"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Lab Test:</h6>
            <div class="dropdown-divider"></div>
            <div class="notify-lab-test-dropdown"></div>
            
          </div>
        </li>
      <li class="nav-item dropdown" >
          <a class="nav-link dropdown-toggle mr-lg-2 click_notify_presc" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning count_chat_ind" style=""></span>
            </span>
            <span class="indicator text-warning d-none d-lg-block " >
              <i class="fa fa-fw fa-circle count-ind-show" style="display: none;"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <div class="show-notify"></div>
            
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