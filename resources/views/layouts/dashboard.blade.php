
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	 <meta name="csrf-token" content="{{ csrf_token() }}">
	{{-- <meta name="description" content="Best Doctors in Nigeria | Online pharmacist consultation | Best Pharmacy in Nigeria -Fokzmedics"> --}}
	
	{{-- <title>Best Doctors in Nigeria | Online pharmacist consultation | Best Pharmacy in Nigeria -Fokzmedics</title> --}}

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
	
	@yield('css')
	<!-- BASE CSS -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
	<link href="{{ asset('css/iziToast.min.css') }}" rel="stylesheet">
	<!-- {{-- <link href="css/bootstrap.min.css" rel="stylesheet"> --}} -->
	

	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- YOUR CUSTOM CSS -->
	
	
	<!-- Modernizr -->
	<!-- {{-- <script src="js/modernizr.js"></script>
	<script src="js/jquery-2.2.4.min.js"></script> --}} -->

<!-- Facebook Pixel Code -->
<!-- <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '280524652849818');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=280524652849818&ev=PageView&noscript=1"
/></noscript> -->
<!-- End Facebook Pixel Code -->



<style type="text/css">
	body{
		color: #333333 !important
	}
	.help-block strong{
		color: red !important
	}
	.msg_cotainer{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 10px;
		border-radius: 25px;
		background-color: #82ccdd;
		padding: 10px;
		position: relative;
	}
	.msg_time{
		position: absolute;
		left: 0;
		bottom: -15px;
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	.msg_cotainer_send{
		margin-top: auto;
		margin-bottom: auto;
		margin-right: 10px;
		border-radius: 25px;
		background-color: #78e08f;
		padding: 10px;
		position: relative;
	}
	.msg_time_send{
		position: absolute;
		right:0;
		bottom: -15px;
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	@yield('style')
		
		.contacts_body{
			padding:  0.75rem 0 !important;
			overflow-y: auto;
			white-space: nowrap;
		}
		.msg_card_body{
			overflow-y: auto;
		}
		
		.type_msg{
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
			height: 60px !important;
			overflow-y: auto;
		}
			.type_msg:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.attach_btn{
	border-radius: 15px 0 0 15px !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.send_btn{
	border-radius: 0 15px 15px 0 !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.search_btn{
			border-radius: 0 15px 15px 0 !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		 .card-footer{
		border-radius: 0 0 15px 15px !important;
			border-top: 0 !important;
	}
	#chatList{
		background: #7F7FD5;
	       background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
	        background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
	}
	p{
		color: #000
	}
	#loader_submit {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url({{asset('img/small.gif')}}) no-repeat center center;
  z-index: 10000;
}

</style>


</head>

<body class="fixed-nav sticky-footer" id="page-top">
<div id="app">
@if(auth()->user()->type==1)
@include('partials.patient_nav')
@elseif(auth()->user()->type==2)
@include('partials.doctor_nav')
@elseif(auth()->user()->type==3)
@include('partials.pharmacist_nav')
@elseif(auth()->user()->type==4)
@include('partials.diagnostics_nav')
@elseif(auth()->user()->type==5)
@include('partials.freelancer_nav')
@elseif(auth()->user()->type==6)
@include('partials.admin_nav')
@elseif(auth()->user()->type==7)
@include('partials.hypaac_nav')
@endif
	<!-- Mobile menu overlay mask -->

	<!--<div id="preloader">-->
	<!--	<div data-loader="circle-side"></div>-->
	<!--</div>-->
	<!-- End Preload -->

	<!-- /header -->	
	

	<div class="content-wrapper">
		<div class="container-fluid">
			<!-- if doctor check if he has set his schedule -->
			@if(auth()->user()->type==2&& auth()->user()->schedules->count()<1)
				<div class="alert alert-info">You have not set your schedule! Click this link to do so <a href="{{route('doctor.schedule')}}">Schedule</a></div>

			@endif

		@if(session()->has('success'))
              <div class="alert alert-success">{{session()->get("success")}}</div>
        @endif
         @if(session()->has('error'))
            <div class="alert alert-danger">{{session()->get("error")}}</div>
         @endif
         @if(request()->path()=="doctor" || request()->path()=="patient" || request()->path()=="freelancer" || request()->path()=="pharmacy" || request()->path()=="diagnostics")
         <div class="alert alert-info alert-dismissible">
         	<input type="" name="" id="myreferal" value="" style="border: none,background:transparent;outline: none;background-color: transparent;border: none;width: 2px">
         	<small>Your referal link : {{route('register')}}?referal={{auth()->user()->email}}</small><br/><a onclick="myFunction()" id="myAText" style="cursor: pointer;" class="ml-2 btn-sm btn-primary" data-toggle="tooltip" title="Click to copy to clipboard">Copy to clipboard</a>
         	 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
         </div>
         @endif
		@yield('content')
	</div>
	</div>
	<!-- /main content -->
	
	
 <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Fokzmedics Technology
Company Limited. 2019</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
	<!--/footer-->

	<
	<!-- Back to top button -->
	

    	<!-- popup modal -->
	
    
	<!-- COMMON SCRIPTS -->
	
	{{-- <script src="users/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
</div>

	<script src="{{asset('js/app.js')}}"></script>
	<script src="{{asset('js/iziToast.min.js')}}"></script>

<script type="text/javascript">
	$(document).ready(function(){
		 $('[data-toggle="tooltip"]').tooltip()
	})
</script>
	<script>
function myFunction() {

  var copyText = document.getElementById("myreferal");
  var aText = document.getElementById("myAText").textContent;
  
  if ({!! auth()->user()->type !!}==2 || {!! auth()->user()->type !!}==5) {
  	 copyText.setAttribute('value', "{!! route('register').'?referal='.auth()->user()->email.'&redirect='.route('viewPractitioner',auth()->user()->id)!!}")
  } else {
  	 copyText.setAttribute('value', "{!! route('register').'?referal='.auth()->user()->email!!}")
  }
 
  //alert(copyText.value)
  //alert(copyText)
  copyText.select();
   copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
       iziToast.success({
    title: 'Success!',
    message: 'Copied to clipboard',
    position: 'topRight'
  });
}
</script>
	@yield('script')
	
	</body>

</html>