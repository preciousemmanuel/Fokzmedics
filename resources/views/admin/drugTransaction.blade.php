@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Drug Transaction</li>
    </ol>


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
          <th>Pharmacy</th>
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
          <td>{{$transaction->pharmacy->business_name}}</td>
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
            @endif
          </td>
          <td>
         
               <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#v{{$transaction->id}}">Action</button>

                 

                 <div class="modal fade" id="v{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View complaint</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="modal-body">
             @if($transaction->status==0||$transaction->status==3)
            <div id="div{{$transaction->id}}">
            <p>Complain type:{{$transaction->complainType}}</p>
            <p>Complain remark:{{$transaction->remark}}</p>
            <p>Complain date:{{$transaction->complainDate}}</p>
            
            </div>

            @endif

              @if($transaction->status==0)
              <button class="btn-sm btn-primary refund" data-id="{{$transaction->id}}" id="r{{$transaction->id}}">Refund</button>
              @endif
             
            
          </div>
          <div class="modal-footer">
            @if($transaction->status!=3 && $transaction->status!==4)
             <button class="btn-sm btn-success pay" id="p{{$transaction->id}}" data-id="{{$transaction->id}}" >Flag as paid</button>
             @endif
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            
          </div>
        
        </div>
      </div>
    </div>

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
  text: "You want to pay pharmacist",
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
    url: '{{ route("admin.disbuseDrugPayment") }}',
    data: {transaction: transaction},
    success: function (data){
      $('#r'+transaction).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Success...",
                  showConfirmButton: false,
                  timer: 2500
                });
       $('#p'+transaction).hide();
       $('#v'+transaction).modal('hide');
       $('#text'+transaction).text('Complete');
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
  
   $('.refund').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You want to mark as refunded",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
var transaction=$(this).attr('data-id');
$('#r'+transaction).html('Wait...')
$('#r'+transaction).prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("admin.drugRefund") }}',
    data: {transaction: transaction},
    success: function (data){
      $('#r'+transaction).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Success...",
                  showConfirmButton: false,
                  timer: 2500
                });
       $('#r'+transaction).hide();
       $('#p'+transaction).hide();
       $('#v'+transaction).modal('hide');
       $('#text'+transaction).text('Refunded');
        console.log("File has been successfully removed!!");
    },
    error: function(e) {
        console.log(e);
        $('#r'+transaction).html('Refund')
$('#r'+transaction).prop('disabled',false)
    }});
}

})
    })
  })  
</script>

@endsection