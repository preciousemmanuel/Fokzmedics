@extends('layouts.main')

@section('title')
<title>Refund Policy - Fokzmedics</title>
@endsection

@section('content')
	<div id="breadcrumb">
			<div class="container">
				<ul>
					<li><a href="/">Home</a></li>
					
					<li>Refund Policy</li>
				</ul>
			</div>
		</div>
		<!-- /breadcrumb -->

		<div class="container margin_60 how-it-works-ul">
			<div class="row">
				
				<div class="col-lg-12" id="faq">
					<h4 class="nomargin_top">Refund Policy</h4>
					
					<div role="tablist" class="add_bottom_45 accordion" id="payment">
						<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a data-toggle="collapse" href="#collapseOne_payment" aria-expanded="true"><i class="indicator icon_minus_alt2"></i>Our refund policy</a>
								</h5>
							</div>

							<div id="collapseOne_payment" class="collapse show" role="tabpanel" data-parent="#payment">
								<div class="card-body">
									<ul>
<li>When you choose to collect purchased items from any of our
partners by yourself, or chooses to send someone else, the package
would not be collected back if there is any manhandling compare to the
state it was when picked up. However, the
goods can be returned within 2 days if item was purchased within the same
city and 7 days for orders outside the city after receiving your original
order with vivid and obvious reasons for return in good shape as it was
collected at the beginning.</li>
<li>Delivery fee would not be refunded since delivery has been done already. You are obligated to return the product by yourself to the pharmacy you purchased it from. For products bought outside the city, contact us at help@fokzmedics.com and you will be directed on how to make the return.</li>
<li> You can reject a product at delivery and your money would be refunded to you in full except the delivery fee and the payment gateway charge.</li>
<h6>Criteria For return</h6>
<li>Pharmaceutical item that are liable to deteriorate at room temperature
would not be collected if returned.</li>
<li>You can return this product ONLY if you have received the wrong product,
if it is expired or if the item has been damaged.</li>
<li>You cannot return the product if you change your mind or you don&#39;t like
the product unless you immediately reject it at delivery point.</li>
<li>It is advised that you verify products okay at point of delivery before
accepting.</li>
<p>Once your return request is done, we will contact you and you would have to
personally make the drop off of the item at the pharmacy you purchased it. Once the product is retrieved, we will proceed to refunding your money.</li>
<p>After the stipulated period of time, the return policy expires and refunds/
returns exchanges are no longer covered.</p>
<p>However, if you are dissatisfied with an item for any reason and the return
policy has expired, you can still contact us at
<a href="mailto:help@fokzmedics.com">help@fokzmedics.com</a>  and we will try to help if we can.</p>
								
									
								</div>
							</div>
						</div>
						<!-- /card -->
						<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a class="collapsed" data-toggle="collapse" href="#collapseTwo_payment" aria-expanded="false">
										<i class="indicator icon_plus_alt2"></i>What are the required conditions for return?
									</a>
								</h5>
							</div>
							<div id="collapseTwo_payment" class="collapse" role="tabpanel" data-parent="#payment">
								<div class="card-body">
									<ul>
									<li>Product must remain sealed, except if the product is defective or damaged</li>
									<li>Product is still in its original package.</li>
										<li>Product is in its original condition and unused.</li>
										
										<li>Product label is still attached</li>
										<li>product is complete</li>
										
									</ul>
							
				
				</div>
				<!-- /col -->
			</div>
			<!-- /row -->
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