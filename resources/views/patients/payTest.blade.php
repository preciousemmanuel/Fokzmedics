
@extends('layouts.dashboard')


@section('content')

    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <div id="loader_submit"></div>
      <div class="alert alert-info">
       <h6> <strong>
       Tests to pay: {{implode(',',$sentTests)}}
     </strong>
   </h6>
      </div>
    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">{{$lab->business_name}}</h2>
        
      </div>
      <div class="list_general">

        <div class="table-responsive">
        <table class="table table-bordered"  width="100%" cellspacing="0">
                      
                        <thead>
                        <tr>
                         
                          <th>Test Name</th>
              
                        </tr>
                      </thead>
                     
                      <tbody>
                      @forelse($tests as $test)
                        <tr>
                          <td>{{$test->test}}</td>
                          
                          <td>{{$test->addon_price}}.00</td>
                        </tr>
                        @empty
                        <h4 class="text-danger">{{$lab->business_name}} do no have this test at this time</h4>
                        @endforelse
                      </tbody>
                    </table>
                    
                    
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                    <h4>Total :
                      @forelse($totalAmount as $total)
                      {{'N '.$total->total}}
                      <input type="hidden" name="" id="total" value="{{$total->total}}">
                      @empty
                      @endforelse
                    </h4>
                    <p style="margin-bottom: 0">Address: {{$lab->address}}</p>
                    <p style="margin-bottom: 0">City: {{$lab->city}}</p>
                    <p style="margin-bottom: 0">Email: {{$lab->email}}</p>
                  </div>
                  <div class="col-md-6">
                    <div class="pretty p-switch p-slim">
                      <input type="checkbox" id="deliveryType" />
                      <div class="state p-success">
                        <label>Home delivery</label>
                      </div>
                    </div>
                    <h5 style="display: none;" id="fee">Delivery Fee: N 1000</h5>
                    <input type="hidden" name="" id="dFee" value="1000">
                    <textarea type="text" style="display: none;" id="address" placeholder="Enter your location EX: Country,City,address" name=""></textarea>
                  </div>
                </div>
                @if(!empty($tests))
                <button class="btn btn-success btn-sm mb-4" id="pay">Pay</button>
                @endif
      </div>
    </div>
    <!-- /box_general-->
    
    <!-- /pagination-->
    </div>
   
  
@endsection

@section('css')
<link href="{{ asset('css/pretty-checkbox.min.css') }}" rel="stylesheet">
@endsection

@section('script')

<script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

<script type="text/javascript">
  $('#deliveryType').click(function(){
    if ($(this).is(":checked")) {
      $('#fee').show()
      $('#address').show()
    }else{
      $('#fee').hide()
      $('#address').hide()
    }
  })

$('#pay').click(function(){
  var total=parseInt($('#total').val());
  var deliveryFee=0;
  
  if ($('#deliveryType').is(':checked')) {
     deliveryFee=parseInt($('#dFee').val())
  } else {
     deliveryFee=0;
  }
  var grandTotal=total+deliveryFee;
  //alert(grandTotal)

   var txref='Fokz'+ Math.floor((Math.random() * 10000000) + 1);

  var x = getpaidSetup({
            PBFPubKey: '{{config('appsettings.FLUTTER_KEY')}}',
            customer_email: '{{$patient->email}}',
            amount: 100,
            customer_phone: "234{{$patient->phone}}",
            currency: "NGN",
            txref: txref,
            custom_logo:"https://fokzmedics.com/img/logo.png",
           
            custom_title:"Fokzmedics",
            onclose: function() {},
            callback: function(response) {
                var txref = response.tx.txRef; // collect txRef returned and pass to a          server page to complete status check.
                console.log("This is the response returned after a charge", response);
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
                   store_payment(txref,grandTotal);
                } else {
                    // redirect to a failure page.
                    console.log('failed')
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });

  

  
})
   
   function store_payment(txref,grandTotal){
  //alert(amount+book_id+doctor_id+transaction_id)
  var spinner = $('#loader_submit');
    spinner.show();
    var address=$('#address').val()
 
  var lab={{$lab->id}}
  $.ajax({
     headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
      type:'POST',
      url:'{{route('patient.saveTestTransaction',$book->id)}}',
      data:{txref:txref,amount:grandTotal,address:address,lab_id:lab},
      success:function(res){
        console.log(res)
        if (res.status) {
        window.location.href="{{route('patient.showTransactionSuccess')}}"
        
      }else{
        window.location.reload();
      }
      },error:function(error){
        console.log('ajax error',error)
        spinner.hide();
      }
    })
}


</script>
@endsection