@extends('layouts.main')

@section('title')
<title>Refund Policy - Fokzmedics</title>
@endsection

@section('content')
	<div id="breadcrumb">
			<div class="container">
				<ul>
					<li><a href="/">Home</a></li>
					
					<li>Disclaimer</li>
				</ul>
			</div>
		</div>
		<!-- /breadcrumb -->

		<div class="container margin_60 how-it-works-ul">
			<div class="row">
			
				
				<div class="col-lg-12" id="faq">
					<h4 class="nomargin_top">Disclaimer</h4>
					
					<div role="tablist" class="add_bottom_45 accordion" id="payment">
						<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a data-toggle="collapse" href="#collapseOne_payment" aria-expanded="true"><i class="indicator icon_minus_alt2"></i>Disclaimer</a>
								</h5>
							</div>

							<div id="collapseOne_payment" class="collapse show" role="tabpanel" data-parent="#payment">
								<div class="card-body">
									<p>Content published on fokzmedics is not intended to be a substitute for professional medical diagnosis, advice or treatment by a trained physician. Seek the advice from your physician or other qualified health-care providers with questions you may have regarding your symptoms and medical condition for a complete medical diagnosis. Do not delay or disregard seeking professional medical advice because of something you have read on this website. </p>
								</div>
							</div>
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