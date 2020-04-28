<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href=""><img src="img/logo.png" data-retina="true" alt="Fokzmedics" > <!-- <h4 style="color: white !important">Fokzmedics</h4> --></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="/users/">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#uploadpre" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-stethoscope"></i>
            <span class="nav-link-text">Send prescription</span>
          </a>
          <ul class="sidenav-second-level collapse" id="uploadpre">
            <li>
              <a href="send-drug-prescription">Send Drug Prescription</a>
            </li>
            <li>
              <a href="send-lab-test">Send Lab Test </a>
            </li>
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#uploadhistory" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-globe"></i>
            <span class="nav-link-text">Sent history</span>
          </a>
          <ul class="sidenav-second-level collapse" id="uploadhistory">
            <li>
              <a href="sent-drug-presc-history">Drug Presc. history</a>
            </li>
      <li>
              <a href="sent-lab-test-history">Lab. Test history</a>
            </li>
          </ul>
        </li>
         
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Bookings">
          <a class="nav-link" href="booking_list">
            <i class="fa fa-fw fa-calendar-check-o"></i>
            <span class="nav-link-text">My Bookings <span class="badge badge-pill badge-danger notify_lab" style="display: none;"></span> </span>
          </a>
        </li>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Chat">
          <a class="nav-link" href="chat-history">
            <i class="fa fa-comment"></i>
            <span class="nav-link-text">Rx Chat Log </span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Automated Medical Lab test">
          <a class="nav-link" id="notify_lab" href="automated-lab-request">
            <i class="fa fa-fw fa-calendar-check-o"></i>
            <span class="nav-link-text">E-Medical Lab test <span class="badge badge-pill badge-danger notify_lab" style="display: none;"></span> </span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Automated Drug Prescription">
          <a class="nav-link" id="notify_drug" href="automated-drug-presc">
            <i class="fa fa-fw fa-calendar-check-o"></i>
            <span class="nav-link-text">E-Drug Prescription <span class="badge badge-pill badge-danger notify_drug" style="display: none;"></span> </span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Lab result">
          <a class="nav-link" href="lab-result">
            <i class="fa fa-medkit"></i>
            <span class="nav-link-text">Lab result</span>
          </a>
        </li>
        
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Transactions">
          <a class="nav-link" href="transactions">
            <i class="fa fa-bullseye"></i>
            <span class="nav-link-text">Transactions</span>
          </a>
        </li>
                 <li class="nav-item" data-toggle="tooltip" data-placement="right" >
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProfile3" data-parent="#exampleAccordion3">
            <i class="fa fa-fw fa-money"></i>
            <span class="nav-link-text">ePurse</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseProfile3">
            <li>
              <a href="#" onclick="return false;" data-toggle="modal" data-target="#currbalmodal">Current Balance</a>
            </li>
              <li>
              <a href="my_purse">My ePurse</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="reviews">
          <a class="nav-link" href="my-reviews">
            <i class="fa fa-star"></i>
            <span class="nav-link-text">My reviews</span>
          </a>
        </li>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile">
          <a class="nav-link" href="user-profile">
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
          <a class="nav-link" href="#chat_pharmacist">
            <i class="fa fa-fw fa-comment"></i>Chat with Pharmacist</a>
        </li>
       
        <li class="nav-item" >
          <a class="nav-link">
            <i class="fa fa-fw fa-bell"></i>400
            
          </a>
          
        </li>
        <li id="user">
              <a href="user-profile">
                <figure><img src="<?php echo $img=(!empty($user['image'])) ? $user['image']:'http://via.placeholder.com/565x565.jpg'; ?>" alt="<?php echo $user['fullname']; ?>" style="border-radius: 50%" width="30px" height="30px"></figure>
                
              </a>
            </li>
        
        <li class="nav-item">
        <a class="nav-link">
        <i class="fa fa-fw fa-user"></i>Name</a></li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
 