@extends('layouts.main')

@section('content')
	
	<div id="breadcrumb">
			<div class="container">
				<ul>
					<li><a href="#">Home</a></li>
					
					<li>Payment</li>
				</ul>
			</div>
		</div>
		<!-- /breadcrumb -->

		<div class="container margin_120">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<h4 class="text-center">Amount to pay NGN {{session('amount')}}</h4>
					<div id="confirm">
						<div class="card">
							<div class="card-header">
								<h5>Payment Options</h5>
							</div>
							<div class="card-body">
							
							<br>
							<br>
							<button id="cardPayment" onclick="window.location.reload()" class="form-control btn btn-info">	Pay with Card</button>
							<br>
							<br>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>


@endsection

@section('script')
<script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<script type="text/javascript">
	var txref='Fokz'+ Math.floor((Math.random() * 10000000) + 1);

	var x = getpaidSetup({
            PBFPubKey: '{{config('appsettings.FLUTTER_KEY')}}',
            customer_email: '{{auth()->user()->email}}',
            amount: '{{session('amount')}}',
            customer_phone: "234{{auth()->user()->phone}}",
            currency: "NGN",
            txref: txref,
            custom_logo:"https://fokzmedics.com/img/logo.png",
           
            custom_title:"Fokzmedics",
            onclose: function() {},
            callback: function(response) {
                var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
                console.log("This is the response returned after a charge", response);
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
                   store_payment(txref);
                } else {
                    // redirect to a failure page.
                    console.log('failed')
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });

	

	function store_payment(txref){
	//alert(amount+book_id+doctor_id+transaction_id)
	$.ajax({
		 headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
			type:'POST',
			url:'{{route('patient.storeBookingPayment',session('bookId'))}}',
			data:{txref:txref},
			success:function(res){
				if (res.status=='success') {
				window.location.href="{{route('patient.showBookingSuccess')}}"
				console.log(res)
			}else{
				window.location.reload();
			}
			},error:function(error){
				console.log('ajax error',error)
			}
		})
}

</script>
@endsection