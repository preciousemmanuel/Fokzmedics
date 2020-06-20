@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Drug Transaction</li>
    </ol>

 <div class="row">
      <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-money"></i>
              </div>
              <div class="mr-5"><h5>{{$paid}} Amount Paid</h5></div>
            </div>
           
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-money"></i>
              </div>
              <div class="mr-5"><h5>{{$pending}} Pending amount</h5></div>
            </div>
           
          </div>
        </div>
       
    </div>
    <br/><br/>
    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Drug Transactions</h2> 
      
      </div>
      <div class="list_general">
       <table class="table table-bordered table-responsive">
      <thead>
        <tr>
          
          <th>Transaction Id</th>
          <th>Drugs</th>
          <th>Amount(N)</th>
          <th>Patient</th>
          
          <th>Date</th>
          <th>Status</th>
          <th></th>
          
        </tr>
      </thead>
      <tbody>
        @foreach($transactions as $transaction)
        <tr>
         
          <td>{{$transaction->trans_ref}}</td>
         
          <td>{{$transaction->book->drugs->pluck('prescriptions')->implode(', ')}}</td>
          <td>{{$transaction->amount}}</td>
          <td>{{$transaction->patient->fullname}}</td>
          
          <td>{{date('Y-M-d h:i a',strtotime($transaction->created_at))}}</td>
          
          <td id="text{{$transaction->id}}">
            @if($transaction->status==1)
            <span class="text-info">Not recieved</span>
            @elseif($transaction->status==0)
            <span class="text-danger">Mark for refund</span>
            @elseif($transaction->status==2)
            <span class="text-success">Recieved</span>
            @elseif($transaction->status==3)
            <span class="text-danger">Refunded</span>
            @elseif($transaction->status==4)
            <span class="text-success">Complete</span>
             @elseif($transaction->status==5)
            <span class="text-success">Flagged as delivered</span>
            @endif
          </td>
          <td>

          @if($transaction->status!=5 && $transaction->status!=4 &&$transaction->status!=3 &&$transaction->status!=2)
             <button class="btn-sm btn-success pay" id="p{{$transaction->id}}" data-id="{{$transaction->id}}" >Mark as delivered</button>
             @endif
          </td>
         
        </tr>
        @endforeach
      </tbody>
    </table>
    
      </div>
      {{$transactions->links()}}
      <br/>
    <br/>
    </div>
   

</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.pay').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You want to continue",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
var transaction=$(this).attr('data-id');
$('#p'+transaction).html('Wait...')
$('#p'+transaction).prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("pharmacy.markDelivered") }}',
    data: {transaction: transaction},
    success: function (data){
      $('#p'+transaction).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Success...",
                  showConfirmButton: false,
                  timer: 2500
                });
       $('#p'+transaction).hide();
       //$('#v'+transaction).modal('hide');
       $('#text'+transaction).text('Flagged delivered');
        console.log("File has been successfully removed!!");
    },
    error: function(e) {
        console.log(e);
        $('#p'+transaction).html('Pay')
$('#p'+transaction).prop('disabled',false)
    }});
}

})
    })
  
   
  })  
</script>

@endsection