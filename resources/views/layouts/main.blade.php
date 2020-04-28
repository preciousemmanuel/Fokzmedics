
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	 <meta name="csrf-token" content="{{ csrf_token() }}">
	{{-- <meta name="description" content="Best Doctors in Nigeria | Online pharmacist consultation | Best Pharmacy in Nigeria -Fokzmedics"> --}}
	@yield('title')
	{{-- <title>Best Doctors in Nigeria | Online pharmacist consultation | Best Pharmacy in Nigeria -Fokzmedics</title> --}}

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
	

	<!-- BASE CSS -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	{{-- <link href="css/bootstrap.min.css" rel="stylesheet"> --}}
	<link href="{{asset('css/slider.css')}}" rel="stylesheet">

	<link href="{{asset('css/style.css')}}" rel="stylesheet">
	<link href="{{asset('css/menu.css')}}" rel="stylesheet">
	<link href="{{asset('css/vendors.css')}}" rel="stylesheet">
	<link href="{{asset('css/css/all_icons_min.css')}}" rel="stylesheet">
	{{-- <link href="css/icon_fonts/css/all_icons_min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('css')
	<!-- YOUR CUSTOM CSS -->
	<link href="{{asset('css/custom.css')}}" rel="stylesheet">
	
	<!-- Modernizr -->
	{{-- <script src="js/modernizr.js"></script>
	<script src="js/jquery-2.2.4.min.js"></script> --}}

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
	.help-block strong{
		color: red !important
	}
	
	.search_li{
  padding: 0px;
  height: 50px;
  width: 100%;
  padding-left: 10px;
   background: #f1f1f1;
  border-bottom: 1px solid #d7d7d7;
  z-index: 100
}

.search_li a{
   display: block;
   font-weight: bold;
   font-size: 13px;
   padding-top: 10px;
   text-align: left;
   position: relative;
}

.search_li a:after{
  content: attr(title);
  position: absolute;
  top: 2.7em;
  left: 0;
  font-size: 0.9em;
  color: #74d1c6
}
.search_li a:hover{
  text-decoration: none;
  display: block;
  width:100%;
  
  height: 50px;
  color: #74d1c6;
}
.search_li:last-child{
  border-bottom: none;
  z-index: 1000
}
</style>


</head>

<body>

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<!--<div id="preloader">-->
	<!--	<div data-loader="circle-side"></div>-->
	<!--</div>-->
	<!-- End Preload -->

    <header class="header_sticky">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-3 col-6">
					<div id="logo_hom">
						<h3><a href="{{route('index')}}" title="Findoctor" style="color: #333"><img src="{{asset('img/logo.png')}} " alt="Fokzmedics"></a></h3>
					</div>
				</div>
<nav class="col-lg-9 col-6">
					<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
					<!-- <ul id="top_access">
						<li><a href="login.html"><i class="pe-7s-user"></i></a></li>
						<li><a href="register-doctor.html"><i class="pe-7s-add-user"></i></a></li>
					</ul> -->
					<div class="main-menu">
						<ul>
							<li><a href="{{route('index')}}">Home</a></li>
							<li><a href="about">About</a></li>
							<li><a href="how-it-works">How it works</a></li>
							<li><a href="{{route('patient.drugUpload')}}">Upload Prescription</a></li>
							
							

							 <!-- Authentication Links -->
                        	@guest
                           <li>
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                             @else
                            <li class="submenu">
                                <a id="navbarDropdown" class="show-submenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fullname }} <span class="fa fa-sort-down"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                	<li>
                                		<a href="{{route('home')}}">Dashboard</a>
                                	</li>
                                    <li>
                                    	<a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                	</li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                        @endguest

							
							<!-- <li><a href="#0">Buy this template</a></li> -->
						</ul>
					</div>
					<!-- /main-menu -->
				</nav>
			</div>
		</div>
		<!-- /container -->
	</header>
	<!-- /header -->	
	
	<main>
		
		@if(session()->has('success'))
              <div class="alert alert-success">{{session()->get("success")}}</div>
        @endif
         @if(session()->has('error'))
            <div class="alert alert-danger">{{session()->get("error")}}</div>
         @endif
		@yield('content')

	</main>
	<!-- /main content -->
	
	
<footer>
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-3 col-md-12">
					<p>
						<a href="/" title="Fokzmedics">
							<img src="img/logo.png" data-retina="true" alt="" width="163" height="36" class="img-fluid">
						</a>
					</p>
				</div>
				<div class="col-lg-3 col-md-4">
					<h5>About</h5>
					<ul class="links">
						<li><a href="about">About us</a></li>
						<li><a href="how-it-works">How it works</a></li>
						<li><a href="return-policy">Return policy</a></li>
						
					</ul>
				</div>
				<div class="col-lg-3 col-md-4">
					<h5>Useful links</h5>
					<ul class="links">
						<li><a href="{{route('register')}}r">Join as our platform</a></li>
						<li><a href="{{route('doctors')}}">Doctors Career</a></li>
						
					</ul>
				</div>
				<div class="col-lg-3 col-md-4">
					<h5>Contact with Us</h5>
					<ul class="contacts">
						<li><a href="tel://61280932400"><i class="icon_mobile"></i> + 234 80 000 000 00</a></li>
						<li><a href="mailto:info@fokzmedics.com"><i class="icon_mail_alt"></i> info@fokzmedics.com</a></li>
					</ul>
					<div class="follow_us">
						<h5>Follow us</h5>
						<ul>
							<li><a href="#0"><i class="social_facebook"></i></a></li>
							<li><a href="#0"><i class="social_twitter"></i></a></li>
							<li><a href="#0"><i class="social_linkedin"></i></a></li>
							<li><a href="#0"><i class="social_instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<!--/row-->
			<hr>
			<div class="row">
				<div class="col-md-8">
					<ul id="additional_links">
						<li><a href="terms-of-use">Terms of use</a></li>
						<li><a href="privacy-policy">Privacy Policy</a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<div id="copy">© 2019 Fokzmedics Technology Company Limited.</div>
				</div>
			</div>
		</div>

</footer>
	<!--/footer-->

	<div id="toTop"></div>
	<!-- Back to top button -->
	

    	<!-- popup modal -->
	<div class="modal fade" id="pop-modal" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #82b541">Welcome to Fokzmedics</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <h6 style="line-height: 20px">Register for free and enjoy commissions
every day for 365 days when you refer a patient or a doctor or a pharmacist.</h6>
          </div>
          <div class="modal-footer">
            <a class="btn btn-success" href="how-it-works" >Learn more</a>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            
            
          </div>
        </div>
      </div>
    </div>
    
	<!-- COMMON SCRIPTS -->
	
	{{-- <script src="users/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}

	<script src="{{asset('js/app.js')}}"></script>
	<script src="{{asset('js/common_scripts.min.js')}}"></script>
	<script src="{{asset('js/functions.js')}}"></script>
	@yield('script')
	</body>

</html>