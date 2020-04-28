
@extends('layouts.dashboard')


@section('content')

    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <div id="loader_submit"></div>
      <div class="alert alert-info">
       <h6> <strong>
       Drugs to buy: {{implode(',',$sentDrugs)}}
     </strong>
   </h6>
      </div>
    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">{{$pharmacy->business_name}}</h2>
        
      </div>
      
      <div class="list_general">
        @if($drugs)
        <div class="table-responsive">
        <table class="table table-bordered"  width="100%" cellspacing="0">
                      
                        <thead>
                        <tr>
                         
                          <th>Drug Name</th>
                          <th>Dosage Form</th>
                          <th>Cost Per Unit(N)</th>
                          <th>Quantity</th>
                          <th>Total(N)</th>
                          
                          

                        </tr>
                      </thead>
                     
                      <tbody>
                      @forelse($drugs as $drug)
                        <tr>
                          <td>{{$drug->prescriptions}}</td>
                          <td>{{$drug->dosage_form}}</td>
                          <td>{{$drug->addon_price}}</td>
                          <td id="quantity_drug">{{$drug->quantity}}</td>
                          <td>{{$drug->quantity*$drug->addon_price}}.00</td>
                        </tr>
                        @empty
                        <h4 class="text-danger">Pharmacy do no have this drugs at this time</h4>
                        @endforelse
                      </tbody>
                    </table>
                    
                    
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                      <h4>
                      @forelse($totalAmount as $total)
                      Total :
                      {{'₦ '.$total->total}}
                      <input type="hidden" name="" id="total" value="{{$total->total}}">
                      @empty
                      @endforelse
                    </h4>
                    <p style="margin-bottom: 0">Address: {{$pharmacy->address}}</p>
                    <p style="margin-bottom: 0">City: {{$pharmacy->city}}</p>
                    <p style="margin-bottom: 0">Email: {{$pharmacy->email}}</p>
                  </div>
                 {{--  <div class="col-md-6">
                    <div class="pretty p-switch p-slim">
                      <input type="checkbox" id="deliveryType" />
                      <div class="state p-success">
                        <label>Home delivery</label>
                      </div>
                    </div>
                    <h5 style="display: none;" id="fee">Delivery Fee: N 1000</h5>
                    <input type="hidden" name="" id="dFee" value="1000">
                    <textarea type="text" style="display: none;" id="address" placeholder="Enter your location EX: Country,City,address" name=""></textarea>
                  </div> --}}
                </div>
                
               {{--  @if(!empty($drugs)) --}}
                <button class="btn btn-success btn-sm mb-4 my-3" id="pay">Pay securely online</button>
                <button class="btn btn-primary btn-sm mb-4 my-3 ml-2" id="dFee" data-toggle="modal" data-target="#payModal">Pay on delivery</button>
                 
                 {{-- @endif --}}
                 @else
                 <h4 class="text-danger">Pharmacy do no have this drugs at this time</h4>
                 <br/>
                 @endif

      </div>
      
    </div>
    <!-- /box_general-->
    
    <!-- /pagination-->
    </div>
   <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pay on delivery</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{route('patient.saveDrugTransaction',$book->id)}}">
            @csrf
            
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <label class="text-success font-weight-bold">Delivery fee:₦300</label>
                
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                @if($drugs)
                <label class="text-primary font-weight-bold">Total fee:{{'₦ '.($total->total?$total->total+300:0)}}</label>
                <input type="hidden" name="amount" value="{{$total->total+300}}">
                @endif
              </div>
              <input type="hidden" name="payOnDelivery" value="1">
              <input type="hidden" name="pharmacy_id" value="{{$pharmacy->id}}">
            </div>
             <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Your phone number</label>
            <input type="text" class="form-control" value="{{auth()->user()->phone}}" name="phone">
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Your city</label>
            <input type="text" class="form-control" value="{{auth()->user()->city}}" name="city">
          </div>
        </div>
      </div>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Your address</label>
            <textarea class="form-control" name="address">{{auth()->user()->address}}</textarea>
          </div>
        </div>
      </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Continue</button>
          </div>
        </form>
        </div>
      </div>
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
 
  var pharmacy={{$pharmacy->id}}
  $.ajax({
     headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
      type:'POST',
      url:'{{route('patient.saveDrugTransaction',$book->id)}}',
      data:{txref:txref,amount:grandTotal,address:address,pharmacy_id:pharmacy},
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