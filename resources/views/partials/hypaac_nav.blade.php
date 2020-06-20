<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="/"><img src="{{asset('img/logo.png')}}" data-retina="true" alt="Fokzmedics" > <!-- <h4 style="color: white !important">Fokzmedics</h4> --></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{route('hypaac.index')}}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        {{-- <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#upload" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-search"></i>
            <span class="nav-link-text">Search</span>
          </a>
          <ul class="sidenav-second-level collapse" id="upload">
            <li>
              <a href="search-drugs">Search Drugs</a>
            </li>
            <li>
              <a href="search-test">Search Test</a>
            </li>
          </ul>
        </li> --}}
       

     
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile">
          <a class="nav-link" href="{{route('hypaac.profile')}}">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">My Profile</span>
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
        <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-fw fa-home"></i> Home</a></li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="fa fa-fw fa-comment"></i>Chat with Pharmacist</a>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2 click_notify_chat_patient" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        <li class="nav-item dropdown" >
          <a class="nav-link" href="">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning count_presc">0</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block " >
              <i class="fa fa-fw fa-circle count_presc_ind">30</i>
            </span>
          </a>
         
        </li>
        <li id="user">
              <a href="user-profile">
                <figure><img src="{{!empty(auth()->user()->image)?asset(auth()->user()->image):asset('img/user.png')}}" alt="wew" style="border-radius: 50%" width="30px" height="30px"></figure>
                
              </a>
            </li>
        
        <li class="nav-item">
        <a class="nav-link">
        <i class="fa fa-fw fa-user"></i>{{auth()->user()->fullname}}</a></li>
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
 