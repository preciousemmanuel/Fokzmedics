@extends('layouts.main')

@section('title')
<title>About us - Fokzmedics</title>
@endsection

@section('content')
	<div id="breadcrumb">
			<div class="container">
				<ul>
					<li><a href="/">Home</a></li>
					
					<li>About us</li>
				</ul>
			</div>
		</div>
		<!-- /breadcrumb -->

		<div class="container margin_60 how-it-works-ul">
			<div class="row">
				<!-- <aside class="col-lg-3" id="sidebar">
						<div class="box_style_cat" id="faq_box">
							<ul id="cat_nav">
								<li><a href="#payment" class="active"><i class="icon_document_alt"></i>Payments</a></li>
								<li><a href="#tips"><i class="icon_document_alt"></i>Suggestions</a></li>
								<li><a href="#reccomendations"><i class="icon_document_alt"></i>Reccomendations</a></li>
								<li><a href="#terms"><i class="icon_document_alt"></i>Terms&amp;conditons</a></li>
								<li><a href="#booking"><i class="icon_document_alt"></i>Booking</a></li>
							</ul>
						</div>
						/sticky 
				</aside> -->
				<!--/aside -->
				
				<div class="col-lg-12" id="faq">
					<h4 class="nomargin_top">About Fokzmedics</h4>
					
					<div role="tablist" class="add_bottom_45 accordion" id="payment">
						<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a data-toggle="collapse" href="#collapseOne_payment" aria-expanded="true"><i class="indicator icon_minus_alt2"></i>About</a>
								</h5>
							</div>

							<div id="collapseOne_payment" class="collapse show" role="tabpanel" data-parent="#payment">
								<div class="card-body">
									<p>
									Fokzmedics is an online medical directory where clients can get access to medical practitioners, like doctors and pharmacist, and health institutions like pharmacy stores, medical laboratory and radiology centre at a convenient and affordable manner within Nigeria. Our goal is to make quality and affordable healthcare delivery and information accessible to all. Our platform also provides an efficient and highly secured escrow payment system that clients can trust during their transactions with the health practitioners and institutions. We give the clients an opportunity to take well informed decisions during their healthcare  journey by making it easy  to get first hand reviews from other clients for a prospective health provider and institution. This and many more you can enjoy when using fokzmedics.com. 
									</p>
	
								<p>Fokzmedics.com is owned by Fokzmedics Technology Limited. An indigenous
company registered with the Corporate Affairs Commission (CAC). RC
1393877</p>
								<p>With the heart to serve you better we are open to suggestions at
<a href="mailto:suggestion@fokzmedics.com">suggestion@fokzmedics.com</a>
Thank you for your patronage. We hope you enjoy our service.</p><br><br>
								</div>
							</div>
						</div>
						<!-- /card -->
						<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a class="collapsed" data-toggle="collapse" href="#collapseTwo_payment" aria-expanded="false">
										<i class="indicator icon_plus_alt2"></i>Vision
									</a>
								</h5>
							</div>
							<div id="collapseTwo_payment" class="collapse" role="tabpanel" data-parent="#payment">
								<div class="card-body">
									<p>To pioneer breaking the frontier of medical &amp; health service and information
delivery in Nigeria.</p>
								</div>
							</div>
						</div>
						<!-- /card -->
						<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a class="collapsed" data-toggle="collapse" href="#collapseThree_payment" aria-expanded="false">
										<i class="indicator icon_plus_alt2"></i>Mission
									</a>
								</h5>
							</div>
							<div id="collapseThree_payment" class="collapse" role="tabpanel" data-parent="#payment">
								<div class="card-body">
									<p>To solve the poor and strenuous accessibility to quality and standard medical
and health service delivery in Nigeria.</p>
								</div>
							</div>
						</div>
						<!-- /card -->
						
						
						
						
					

		</div>
@endsection


@section('css')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
@endsection

@section('script')
{{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    flatpickr('#time_input',{
  		enableTime:true,
  		enableSeconds:true,
  		noCalendar: true,
	});
</script> --}}
@endsection